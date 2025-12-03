<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\User_Userrole;
use App\Models\Category; 
use App\Models\Country; 
use App\Models\City;
use App\Models\Company;
use App\Models\Category_Company;
use App\Models\Country_Company;
use App\Models\Module;
use App\Models\Company_Module;
use App\Models\CompanySetting;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Discount;
use App\Models\Department;
use App\Models\OfficeLocation;

class UsersController extends Controller
{

	public function signUpPosted(Request $request){
		// Validate the request
		$validated = $request->validate([
			'company_name' => 'required|string|min:3',
			'company_address' => 'required|string|min:10',
			'city_id' => 'required|exists:cities,id',
			'your_name' => 'required|string|min:3',
			'userrole_id' => 'required|exists:userroles,id',
			'email' => 'required|email',
			'phone' => 'required|string',
		]);

		try {
			DB::beginTransaction();

			// Generate slug from company name
			$slug = friendlyURL($request->company_name);
			
			// Make slug unique if company already exists
			$originalSlug = $slug;
			$counter = 1;
			while (Company::where('slug', $slug)->exists()) {
				$slug = $originalSlug . '-' . $counter;
				$counter++;
			}

			// Create company
			$company = new Company();
			$company->title = $request->company_name;
			$company->slug = $slug;
			$company->save();
			$companyId = $company->id;

			// Create location
			DB::table('locations')->insert([
				'company_id' => $companyId,
				'address' => $request->company_address,
				'city_id' => $request->city_id,
				'title' => 'Head Office',
				'created_at' => now(),
				'updated_at' => now(),
			]);

			// Find or create user by email
			$existingUser = User::where('email', $request->email)->first();
			$randomPassword = null;
			if ($existingUser) {
				// Reuse existing user id; do not modify existing user details
				$userId = $existingUser->id;
			} else {
				// Create new user with random password
				$randomPassword = Str::random(12);
				$user = new User();
				$user->name = $request->your_name;
				$user->email = $request->email;
				$user->phone = $request->phone;
				$user->password = encryptPassword($randomPassword);
				$user->save();
				$userId = $user->id;
			}

			// Create user-userrole relationship
			$userUserrole = new User_Userrole();
			$userUserrole->user_id = $userId;
			$userUserrole->userrole_id = $request->userrole_id;
			$userUserrole->company_id = $companyId;
			$userUserrole->save();

			DB::commit();

			// Redirect with success message
			if ($randomPassword) {
				return redirect('/login')->with('success', 'Sign up successful! Your password is: ' . $randomPassword);
			}
			return redirect('/login')->with('success', 'Sign up successful! You can log in with your existing account.');

		} catch (\Exception $e) {
			DB::rollBack();
			
			return redirect()->back()
				->withInput()
				->with('error', 'Sign up failed. Please try again.');
		}

	}
	public function signUp(){
		$table = 'users';

		$allCats = Category::get();
		$allCountry = Country::get();
		
		return view('users.sign-up', compact('table', 'allCats', 'allCountry'));
	}
	public function resetPassword(Request $request){
		
		$validated = $request->validate([
	        'email' => 'required|email',
	    ]);

		$user = User::where(['email' => $request->get('email')])->first();
		// dd($user);
		if($user){
			$newPass = Str::random(8);
			$user->password = Hash::make($newPass);
			$user->save();

			return redirect('/')->with('success', 'Password generated, "'.$newPass.'"');
		}else{
			return redirect('/forgot-password')->with('error', 'Invalid email');
		}
		
	}

	public function updatePassword(Request $request){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		$validated = $request->validate([
	        'current_password' => 'required',
	        'new_password' => 'required',
	        'confirm_new_password' => 'required',
	    ]);

		$user = User::where(['id' => auth()->user()->id])->first();
		
		if(!Hash::check($request->get('current_password'), $user->password)){
			return redirect('change-password')->with('error', 'Current Password is not correct');
		}else if($request->get('new_password') != $request->get('confirm_new_password')){
			return redirect('change-password')->with('error', 'Both new password are not matching');
		}else{
			$user->password = encryptPassword($request->get('new_password'));
			$user->save();
			return redirect('change-password')->with('success', 'Password Updated');
		}
	}

	public function password(){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		$table = 'users';
		return view('users.password', compact('table'));
	}

	public function forgotPassword(){
		$table = 'users';
		return view('users.forgot-password', compact('table'));
	}

	
    public function login(Request $request){
    	$username = $request->input('username');
    	$password = $request->input('password');
		
    	$validated = $request->validate([
	        'username' => 'required|email',
	        'password' => 'required',
	    ]);
		
    	$checkUser = User::where(['email' => $username])->first();
		
    	if($checkUser != null){
			
    		$pass = Hash::check($password, $checkUser->password);
    		if($pass == true){
				
    			$success = auth()->attempt([
				    'email' => $username,
				    'password' => $password
				], request());

				$userrolesData = User_Userrole::where(['user_id' => auth()->user()->id])
											  ->get();
				$userroles = [];
				$companies = [];
				foreach($userrolesData as $urd){
					$userroles[] = $urd->userrole_id;
					if(\Session::get('loggedInUserRoles') && in_array('3', \Session::get('loggedInUserRoles'))){
						$companies[] = $urd->company_id;
					}
				}
				
				\Session::put('loggedInUserRoles', $userroles);
				\Session::put('loggedInUserCompanies', $companies);
				// dd($userroles);
				if(in_array('1', $userroles)){
					return redirect('super-admin-dashboard');
				}else{
				return redirect('dashboard');
				}
    		}else{
    			return view('users.login')->with('error', 'Combination of Email Address and Password are not correct!');	
    		}
    	}else{
    		return view('users.login')->with('error', 'Invalid Email or not registered with us!');
    	}

    }

    public function logout(){
    	// Clear session data even if user is not authenticated (handles session timeout)
    	if (auth()->check()) {
    		auth()->logout();
    	}
    	
    	// Clear all session data
    	\Session::flush();
    	
    	return redirect('/login')->with('success', 'Session expired. Please login again.');
    }

	public function index(){
		return view('users.login');	
    }

    public function dashboard(Request $request){
		
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Check if user is company admin
		$userRoles = \Session::get('loggedInUserRoles', []);
		$isCompanyAdmin = in_array('3', $userRoles);
		
		// If not company admin, show employee dashboard
		if (!$isCompanyAdmin) {
			// Get today's check-in status
			$today = date('Y-m-d');
			$todayCheckIn = \DB::table('attendance')
				->where('user_id', auth()->user()->id)
				->whereDate('attendance_date', $today)
				->first();
			
			// Get current month start and today's date (only show up to today)
			$currentMonthStart = date('Y-m-01');
			$today = date('Y-m-d');
			
			// Get all attendance records for current month up to today
			$allAttendanceRecords = \DB::table('attendance')
				->where('user_id', auth()->user()->id)
				->whereDate('attendance_date', '>=', $currentMonthStart)
				->whereDate('attendance_date', '<=', $today)
				->orderBy('attendance_date', 'desc')
				->get()
				->keyBy(function($record) {
					return date('Y-m-d', strtotime($record->attendance_date ?? $record->checkin));
				});
			
			// Get holidays for exclusion
			$holidays = \DB::table('holidays')
				->whereNull('deleted_at')
				->pluck('holiday_date')
				->map(function($date) {
					return date('Y-m-d', strtotime($date));
				})
				->toArray();
			
			// Get approved leaves for current month up to today
			$monthLeaves = \DB::table('leaves')
				->where('leaves.user_id', auth()->user()->id)
				->where('leaves.status', 'a')
				->whereDate('leaves.start_date', '<=', $today)
				->whereDate('leaves.end_date', '>=', $currentMonthStart)
				->whereNull('leaves.deleted_at')
				->get();
			
			// Generate all working days from month start up to today (excluding weekends and holidays)
			$allDays = [];
			$currentDate = new \DateTime($currentMonthStart);
			$endDate = new \DateTime($today); // Only up to today
			
			while ($currentDate <= $endDate) {
				$dayOfWeek = $currentDate->format('w'); // 0 = Sunday, 6 = Saturday
				$dateStr = $currentDate->format('Y-m-d');
				
				// Only include working days (not weekends and not holidays)
				if ($dayOfWeek != 0 && $dayOfWeek != 6 && !in_array($dateStr, $holidays)) {
					// Check if date is in leave period
					$isOnLeave = false;
					foreach ($monthLeaves as $leave) {
						if ($dateStr >= $leave->start_date && $dateStr <= $leave->end_date) {
							$isOnLeave = true;
							break;
						}
					}
					
					// Skip if on leave (leave days are not considered absent)
					if (!$isOnLeave) {
						$allDays[] = [
							'date' => $dateStr,
							'attendance' => $allAttendanceRecords->get($dateStr)
						];
					}
				}
				
				$currentDate->modify('+1 day');
			}
			
			// Sort by date descending
			usort($allDays, function($a, $b) {
				return strtotime($b['date']) - strtotime($a['date']);
			});
			
			// Paginate manually
			$perPage = 10;
			$currentPage = request()->get('page', 1);
			$offset = ($currentPage - 1) * $perPage;
			$paginatedDays = array_slice($allDays, $offset, $perPage);
			$totalDays = count($allDays);
			$totalPages = ceil($totalDays / $perPage);
			
			// Create paginator-like object for view
			$attendanceRecords = new LengthAwarePaginator(
				$paginatedDays,
				$totalDays,
				$perPage,
				$currentPage,
				['path' => request()->url(), 'query' => request()->query()]
			);
			
			// Get today's leave status
			$todayLeave = \DB::table('leaves')
				->where('leaves.user_id', auth()->user()->id)
				->where('leaves.status', 'a')
				->whereDate('leaves.start_date', '<=', $today)
				->whereDate('leaves.end_date', '>=', $today)
				->whereNull('leaves.deleted_at')
				->leftJoin('leavetypes', 'leaves.leavetype_id', '=', 'leavetypes.id')
				->select('leaves.*', 'leavetypes.title as leave_type_name')
				->first();
			
			// Get leaves stats
			// Get total approved leaves count (status = 'a')
			$usedLeaves = \DB::table('leaves')
				->where('leaves.user_id', auth()->user()->id)
				->where('leaves.status', 'a')
				->whereNull('leaves.deleted_at')
				->get();
			
			// Get holidays for exclusion
			$holidays = \DB::table('holidays')
				->whereNull('deleted_at')
				->pluck('holiday_date')
				->map(function($date) {
					return date('Y-m-d', strtotime($date));
				})
				->toArray();
			
			// Calculate total days used (excluding weekends and holidays)
			$totalDaysUsed = 0;
			foreach ($usedLeaves as $leave) {
				$start = new \DateTime($leave->start_date);
				$end = new \DateTime($leave->end_date);
				
				// Loop through each day from start to end (inclusive)
				$currentDate = clone $start;
				while ($currentDate <= $end) {
					$dayOfWeek = $currentDate->format('w'); // 0 = Sunday, 6 = Saturday
					$dateStr = $currentDate->format('Y-m-d');
					
					// Count only if it's not a weekend and not a holiday
					if ($dayOfWeek != 0 && $dayOfWeek != 6 && !in_array($dateStr, $holidays)) {
						$totalDaysUsed++;
					}
					
					$currentDate->modify('+1 day');
				}
			}
			
			// Get company settings for leave limits (assuming these are set in company settings)
			$activeCompanyId = $this->getActiveCompanyId();
			$companySettings = null;
			if ($activeCompanyId) {
				$companySettings = \DB::table('companysettings')
					->where('company_id', $activeCompanyId)
					->first();
			}
			
			// Calculate total leaves (sum of all leave types from company settings)
			$totalLeaves = 0;
			if ($companySettings) {
				$totalLeaves = ($companySettings->casual_leaves ?? 0) +
							   ($companySettings->sick_leaves ?? 0) +
							   ($companySettings->emergency_leaves ?? 0) +
							   ($companySettings->maternity_leaves ?? 0) +
							   ($companySettings->paternity_leaves ?? 0) +
							   ($companySettings->bereavement_leave ?? 0) +
							   ($companySettings->compensation_leaves ?? 0);
			}
			
			$leavesStats = [
				'total' => $totalLeaves,
				'used' => $totalDaysUsed,
				'remaining' => max(0, $totalLeaves - $totalDaysUsed)
			];
			
			// Get alerts/notifications
			$alerts = auth()->user()->unreadNotifications()->limit(5)->get();
			
			return view('users.employee-dashboard', compact('todayCheckIn', 'attendanceRecords', 'leavesStats', 'alerts', 'todayLeave'));
		}
		
		// Company admin dashboard
		// Get active company ID (currently selected company)
		$activeCompanyId = $this->getActiveCompanyId();
		
		// Get selected date from request (default to today)
		$selectedDate = $request->input('date', date('Y-m-d'));
		
		// Get employees for the active company
		$employees = collect([]);
		$departments = [];
		$officeLocations = [];
		$todayAttendance = [];
		if ($activeCompanyId) {
			
			$employees = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
				$query->where('company_id', $activeCompanyId);
			})
			->with(['userRoles.department', 'userRoles'])
			->orderBy('title', 'asc')
			->paginate(10);
			
			$employeeIds = $employees->pluck('id')->toArray();
			if (!empty($employeeIds)) {
				// Get attendance for the selected date
				$attendanceRecords = DB::table('attendance')
					->whereIn('user_id', $employeeIds)
					->whereDate('checkin', $selectedDate)
					->get()
					->keyBy('user_id');
				
				foreach ($attendanceRecords as $record) {
					$todayAttendance[$record->user_id] = $record;
				}
				
				// Get leave status for the selected date
				$todayLeaves = DB::table('leaves')
					->whereIn('leaves.user_id', $employeeIds)
					->where('leaves.status', 'a')
					->whereDate('leaves.start_date', '<=', $selectedDate)
					->whereDate('leaves.end_date', '>=', $selectedDate)
					->whereNull('leaves.deleted_at')
					->leftJoin('leavetypes', 'leaves.leavetype_id', '=', 'leavetypes.id')
					->select('leaves.user_id', 'leaves.start_date', 'leaves.end_date', 'leavetypes.title as leave_type_name')
					->get()
					->keyBy('user_id');
			} else {
				$todayLeaves = collect([]);
			}
			
			// Get unique departments from all employees (not just current page)
			$allEmployees = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
				$query->where('company_id', $activeCompanyId);
			})
			->with(['userRoles.department'])
			->get();
			
			$departments = $allEmployees->flatMap(function($employee) {
				return $employee->userRoles->map(function($userRole) {
					return $userRole->department;
				})->filter();
			})->unique('id')->values();
			
			// Get office locations for the active company
			$officeLocations = OfficeLocation::where('company_id', $activeCompanyId)
				->orderBy('title', 'asc')
				->get();
			
			// Get all employee IDs for the company
			$allEmployeeIds = $allEmployees->pluck('id')->toArray();
			
			// Get pending leave requests for company employees
			$leaveRequests = DB::table('leaves')
				->whereIn('leaves.user_id', $allEmployeeIds)
				->where('leaves.status', 'p')
				->whereNull('leaves.deleted_at')
				->join('users', 'leaves.user_id', '=', 'users.id')
				->leftJoin('leavetypes', 'leaves.leavetype_id', '=', 'leavetypes.id')
				->select(
					'leaves.*',
					'users.title as employee_name',
					'leavetypes.title as leave_type_name'
				)
				->orderBy('leaves.created_at', 'desc')
				->limit(5)
				->get();
		} else {
			$leaveRequests = collect([]);
			$todayLeaves = collect([]);
		}
		
		// Get selected date from request (default to today)
		$selectedDate = $request->input('date', date('Y-m-d'));
		
		// Get company settings for check-in time and grace period
		$companySettings = null;
		if ($activeCompanyId) {
			$companySettings = CompanySetting::where('company_id', $activeCompanyId)->first();
		}
		
		// Calculate statistics for selected date
		$stats = [
			'present' => 0,
			'active' => 0,
			'onBreak' => 0,
			'late' => 0,
			'onLeaves' => 0,
			'absent' => 0,
			'total' => 0
		];
		
		if ($activeCompanyId && !empty($allEmployeeIds)) {
			$stats['total'] = count($allEmployeeIds);
			$stats['active'] = count($allEmployeeIds); // All employees are considered active
			
			// Get leave status for selected date
			$selectedDateLeaves = DB::table('leaves')
				->whereIn('leaves.user_id', $allEmployeeIds)
				->where('leaves.status', 'a')
				->whereDate('leaves.start_date', '<=', $selectedDate)
				->whereDate('leaves.end_date', '>=', $selectedDate)
				->whereNull('leaves.deleted_at')
				->pluck('user_id')
				->toArray();
			$stats['onLeaves'] = count($selectedDateLeaves);
			
			// Get attendance records for selected date
			$allTodayAttendance = DB::table('attendance')
				->whereIn('user_id', $allEmployeeIds)
				->whereDate('checkin', $selectedDate)
				->get()
				->keyBy('user_id');
			
			$stats['present'] = count($allTodayAttendance);
			
			// Calculate late check-ins
			if ($companySettings && $companySettings->check_in_time) {
				$expectedCheckIn = $companySettings->check_in_time;
				
				// Get grace period in minutes
				$gracePeriodMinutes = 0;
				if ($companySettings->grace_period) {
					switch($companySettings->grace_period) {
						case 'no-grace':
							$gracePeriodMinutes = 0;
							break;
						case '5-min':
							$gracePeriodMinutes = 5;
							break;
						case '10-min':
							$gracePeriodMinutes = 10;
							break;
						case '15-min':
							$gracePeriodMinutes = 15;
							break;
						case '30-min':
							$gracePeriodMinutes = 30;
							break;
					}
				}
				
				// Calculate allowed check-in time
				$expectedDateTime = new \DateTime($expectedCheckIn);
				$expectedDateTime->modify("+{$gracePeriodMinutes} minutes");
				$allowedCheckInTime = $expectedDateTime->format('H:i');
				
				// Check each attendance record for late check-ins
				foreach ($allTodayAttendance as $attendance) {
					if ($attendance->created_at) {
						$checkInTime = date('H:i', strtotime($attendance->created_at));
						$checkInDateTime = new \DateTime($checkInTime);
						$allowedDateTime = new \DateTime($allowedCheckInTime);
						
						if ($checkInDateTime > $allowedDateTime) {
							$stats['late']++;
						}
					}
				}
			}
			
			// Calculate absent: employees not on leave and not checked in
			$presentEmployeeIds = $allTodayAttendance->keys()->toArray();
			$presentOrOnLeaveIds = array_unique(array_merge($presentEmployeeIds, $selectedDateLeaves));
			$stats['absent'] = max(0, $stats['total'] - count($presentOrOnLeaveIds));
		}
		
		return view('users.dashboard', compact('employees', 'departments', 'officeLocations', 'todayAttendance', 'leaveRequests', 'todayLeaves', 'companySettings', 'stats', 'selectedDate'));	
    	
    }

    /**
     * Display calendar with leaves and holidays.
     */
    public function calendar(Request $request)
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Check if user is company admin
        $userRoles = \Session::get('loggedInUserRoles', []);
        $isCompanyAdmin = in_array('3', $userRoles);

        if (!$isCompanyAdmin) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Get active company ID
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('dashboard')->with('error', 'No company found. Please contact administrator.');
        }

        // Get company settings for calendar_country_id
        $companySettings = CompanySetting::where('company_id', $activeCompanyId)->first();
        $calendarCountryId = $companySettings->calendar_country_id ?? null;

        // Get selected month/year from request (default to current month)
        $selectedMonth = $request->input('month', date('m'));
        $selectedYear = $request->input('year', date('Y'));
        $selectedDate = new \DateTime("$selectedYear-$selectedMonth-01");

        // Get all employees for the company
        $allEmployees = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
            $query->where('company_id', $activeCompanyId);
        })
        ->with(['userRoles.department'])
        ->get();

        $employeeIds = $allEmployees->pluck('id')->toArray();

        // Get all leaves (approved and pending) for the selected month
        $monthStart = $selectedDate->format('Y-m-01');
        $monthEnd = $selectedDate->format('Y-m-t');
        
        $leaves = DB::table('leaves')
            ->whereIn('leaves.user_id', $employeeIds)
            ->whereIn('leaves.status', ['a', 'p']) // Approved and pending
            ->whereDate('leaves.start_date', '<=', $monthEnd)
            ->whereDate('leaves.end_date', '>=', $monthStart)
            ->whereNull('leaves.deleted_at')
            ->join('users', 'leaves.user_id', '=', 'users.id')
            ->leftJoin('leavetypes', 'leaves.leavetype_id', '=', 'leavetypes.id')
            ->select(
                'leaves.id',
                'leaves.user_id',
                'leaves.start_date',
                'leaves.end_date',
                'leaves.status',
                'users.title as employee_name',
                'leavetypes.title as leave_type_name'
            )
            ->get();

        // Get holidays for the selected month
        // Check if holidays table has country_id column
        $holidaysQuery = DB::table('holidays')
            ->whereNull('deleted_at')
            ->whereYear('holiday_date', $selectedYear)
            ->whereMonth('holiday_date', $selectedMonth);
        
        // If calendar_country_id is set and holidays table has country_id, filter by it
        if ($calendarCountryId) {
            // Check if country_id column exists in holidays table
            $columns = DB::select("SHOW COLUMNS FROM holidays LIKE 'country_id'");
            if (!empty($columns)) {
                $holidaysQuery->where('country_id', $calendarCountryId);
            }
        }
        
        $holidays = $holidaysQuery
            ->select('id', 'title', 'holiday_date')
            ->orderBy('holiday_date', 'asc')
            ->get();

        // Get country name if calendar_country_id is set
        $country = null;
        if ($calendarCountryId) {
            $country = Country::find($calendarCountryId);
        }

        return view('users.calendar', compact('leaves', 'holidays', 'selectedMonth', 'selectedYear', 'selectedDate', 'country', 'allEmployees'));
    }
    
    public function checkIn(Request $request) {
		if (!auth()->check()) {
			return response()->json(['success' => false, 'message' => 'Please login to access this page.']);
		}
		
		// Get today's date - this is the date when the employee clicked check in
		$attendanceDate = date('Y-m-d'); // Current date when check-in button is clicked
		$checkin = date('H:i:s');
		// Check if already checked in today
		$existingCheckIn = DB::table('attendance')
			->where('user_id', auth()->user()->id)
			->whereDate('attendance_date', $attendanceDate)
			->first();
		
		if ($existingCheckIn) {
			return response()->json(['success' => false, 'message' => 'You have already checked in today.']);
		}
		
		// Create check-in record with today's date as attendance_date
		DB::table('attendance')->insert([
			'user_id' => auth()->user()->id,
			'location_id' => 0, // Default location ID
			'expected_hours' => '8', // Default expected hours
			'hours_worked' => 0, // Store as number, not string
			'checkin' => $checkin, // Store the time when employee clicked check in
			'created_at' => now(), // Check-in timestamp
			'updated_at' => now(),
			'attendance_date' => $attendanceDate // Store the date when employee clicked check in
		]);
		
		return response()->json(['success' => true, 'message' => 'Checked in successfully!']);
	}
	
	public function checkOut(Request $request) {
		if (!auth()->check()) {
			return response()->json(['success' => false, 'message' => 'Please login to access this page.']);
		}
		
		$today = date('Y-m-d');
		// Check if checked in today
		$checkIn = DB::table('attendance')
			->where('user_id', auth()->user()->id)
			->whereDate('attendance_date', $today)
			->first();
		
		if (!$checkIn) {
			return response()->json(['success' => false, 'message' => 'You need to check in first.']);
		}
		
		// Calculate actual hours (simplified - you may want to use check_in_time and check_out_time)
		$checkInTime = strtotime($checkIn->created_at);
		$checkOutTime = time();
		$actualHours = round(($checkOutTime - $checkInTime) / 3600, 2);
		
		// Update attendance record
		DB::table('attendance')
			->where('id', $checkIn->id)
			->update([
				'hours_worked' => $actualHours, // Update hours_worked with calculated hours
				// 'actual_hours' => $actualHours,
				'updated_at' => now()
			]);
		
		return response()->json(['success' => true, 'message' => 'Checked out successfully!']);
	}
	
	public function markAttendance() {
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Get today's check-in status
		$today = date('Y-m-d');
		$todayCheckIn = DB::table('attendance')
			->where('user_id', auth()->user()->id)
			->whereDate('attendance_date', $today)
			->first();
		
		// Get current month start and today's date (only show up to today)
		$currentMonthStart = date('Y-m-01');
		
		// Get all attendance records for current month up to today
		$allAttendanceRecords = DB::table('attendance')
			->where('user_id', auth()->user()->id)
			->whereDate('attendance_date', '>=', $currentMonthStart)
			->whereDate('attendance_date', '<=', $today)
			->orderBy('attendance_date', 'desc')
			->get()
			->keyBy(function($record) {
				return date('Y-m-d', strtotime($record->attendance_date ?? $record->checkin));
			});
		
		// Get holidays for exclusion
		$holidays = DB::table('holidays')
			->whereNull('deleted_at')
			->pluck('holiday_date')
			->map(function($date) {
				return date('Y-m-d', strtotime($date));
			})
			->toArray();
		
		// Get approved leaves for current month up to today
		$monthLeaves = DB::table('leaves')
			->where('leaves.user_id', auth()->user()->id)
			->where('leaves.status', 'a')
			->whereDate('leaves.start_date', '<=', $today)
			->whereDate('leaves.end_date', '>=', $currentMonthStart)
			->whereNull('leaves.deleted_at')
			->get();
		
		// Generate all working days from month start up to today (excluding weekends and holidays)
		$allDays = [];
		$currentDate = new \DateTime($currentMonthStart);
		$endDate = new \DateTime($today); // Only up to today
		
		while ($currentDate <= $endDate) {
			$dayOfWeek = $currentDate->format('w'); // 0 = Sunday, 6 = Saturday
			$dateStr = $currentDate->format('Y-m-d');
			
			// Only include working days (not weekends and not holidays)
			if ($dayOfWeek != 0 && $dayOfWeek != 6 && !in_array($dateStr, $holidays)) {
				// Check if date is in leave period
				$isOnLeave = false;
				foreach ($monthLeaves as $leave) {
					if ($dateStr >= $leave->start_date && $dateStr <= $leave->end_date) {
						$isOnLeave = true;
						break;
					}
				}
				
				// Skip if on leave (leave days are not considered absent)
				if (!$isOnLeave) {
					$allDays[] = [
						'date' => $dateStr,
						'attendance' => $allAttendanceRecords->get($dateStr)
					];
				}
			}
			
			$currentDate->modify('+1 day');
		}
		
		// Sort by date descending
		usort($allDays, function($a, $b) {
			return strtotime($b['date']) - strtotime($a['date']);
		});
		
		// Paginate manually
		$perPage = 10;
		$currentPage = request()->get('page', 1);
		$offset = ($currentPage - 1) * $perPage;
		$paginatedDays = array_slice($allDays, $offset, $perPage);
		$totalDays = count($allDays);
		
		// Create paginator-like object for view
		$attendanceRecords = new LengthAwarePaginator(
			$paginatedDays,
			$totalDays,
			$perPage,
			$currentPage,
			['path' => request()->url(), 'query' => request()->query()]
		);
		
		return view('users.mark-attendance', compact('todayCheckIn', 'attendanceRecords'));
	}
	
	public function updateAttendance($employeeId) {
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Check if user is company admin
		$userRoles = \Session::get('loggedInUserRoles', []);
		$isCompanyAdmin = in_array('3', $userRoles);
		
		if (!$isCompanyAdmin) {
			return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
		}
		
		// Get active company ID
		$activeCompanyId = $this->getActiveCompanyId();
		
		// Verify employee belongs to the company
		$employee = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
			$query->where('company_id', $activeCompanyId);
		})
		->where('id', $employeeId)
		->first();
		
		if (!$employee) {
			return redirect()->route('dashboard')->with('error', 'Employee not found or you do not have permission.');
		}
		
		// Get employee's attendance records (last 30 days)
		$attendanceRecords = DB::table('attendance')
			->where('user_id', $employeeId)
			->whereDate('checkin', '>=', date('Y-m-d', strtotime('-30 days')))
			->orderBy('checkin', 'desc')
			->get();
		
		// Get today's attendance record if it exists
		$todayAttendance = DB::table('attendance')
			->where('user_id', $employeeId)
			->whereDate('checkin', date('Y-m-d'))
			->first();
		
		return view('users.update-attendance', compact('employee', 'attendanceRecords', 'todayAttendance'));
	}
	
	public function saveAttendance(Request $request, $employeeId) {
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Check if user is company admin
		$userRoles = \Session::get('loggedInUserRoles', []);
		$isCompanyAdmin = in_array('3', $userRoles);
		
		if (!$isCompanyAdmin) {
			return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
		}
		
		// Get active company ID
		$activeCompanyId = $this->getActiveCompanyId();
		
		// Verify employee belongs to the company
		$employee = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
			$query->where('company_id', $activeCompanyId);
		})
		->where('id', $employeeId)
		->first();
		
		if (!$employee) {
			return redirect()->route('dashboard')->with('error', 'Employee not found or you do not have permission.');
		}
		
		// Validate the request
		$validated = $request->validate([
			'attendance_date' => 'required|date',
			'checkin_time' => 'required|date_format:H:i',
			'checkout_time' => 'nullable|date_format:H:i',
		]);
		
		// Additional validation: checkout time must be after checkin time
		if ($request->checkout_time && $request->checkout_time <= $request->checkin_time) {
			return redirect()->back()
				->withInput()
				->with('error', 'Check out time must be after check in time.');
		}
		
		$attendanceDate = $request->attendance_date;
		
		// Check if attendance record exists for this date
		$existingAttendance = DB::table('attendance')
			->where('user_id', $employeeId)
			->whereDate('checkin', $attendanceDate)
			->first();
		
		// Combine date and time for check-in
		$checkinDateTime = $attendanceDate . ' ' . $request->checkin_time . ':00';
		$checkoutDateTime = $request->checkout_time ? $attendanceDate . ' ' . $request->checkout_time . ':00' : null;
		
		// Calculate hours worked if checkout time is provided
		$hoursWorked = 0;
		if ($checkoutDateTime) {
			$checkinTimestamp = strtotime($checkinDateTime);
			$checkoutTimestamp = strtotime($checkoutDateTime);
			$hoursWorked = round(($checkoutTimestamp - $checkinTimestamp) / 3600, 2);
		}
		
		if ($existingAttendance) {
			// Update existing attendance
			// Note: We can't directly update created_at in Laravel, so we'll use DB::statement for it
			DB::statement("UPDATE attendance SET 
				checkin = ?,
				checkout = ?,
				hours_worked = ?,
				created_at = ?,
				updated_at = ?
				WHERE id = ?", [
				$attendanceDate,
				$checkoutDateTime ? date('Y-m-d H:i:s', strtotime($checkoutDateTime)) : null,
				$hoursWorked,
				date('Y-m-d H:i:s', strtotime($checkinDateTime)),
				now(),
				$existingAttendance->id
			]);
		} else {
			// Create new attendance record
			DB::table('attendance')->insert([
				'user_id' => $employeeId,
				'location_id' => 0,
				'expected_hours' => '8',
				'hours_worked' => $hoursWorked,
				'checkin' => $attendanceDate,
				'checkout' => $checkoutDateTime ? date('Y-m-d H:i:s', strtotime($checkoutDateTime)) : null,
				'created_at' => date('Y-m-d H:i:s', strtotime($checkinDateTime)),
				'updated_at' => now()
			]);
		}
		
		return redirect()->route('update-attendance', $employeeId)
			->with('success', 'Attendance updated successfully!');
	}
	
	public function applyLeave() {
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Get all leave types from database
		$leaveTypes = DB::table('leavetypes')
			->orderBy('title', 'asc')
			->get();
		
		// Get all holidays from database
		$holidays = DB::table('holidays')
			->whereNull('deleted_at')
			->select('holiday_date')
			->get()
			->pluck('holiday_date')
			->map(function($date) {
				return date('Y-m-d', strtotime($date));
			})
			->toArray();
		
		return view('users.apply-leave', compact('leaveTypes', 'holidays'));
	}
	
	public function storeLeave(Request $request) {
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Validate the request
		$validated = $request->validate([
			'leavetype_id' => 'required|exists:leavetypes,id',
			'start_date' => 'required|date|after_or_equal:today',
			'end_date' => 'required|date|after_or_equal:start_date',
		]);
		
		// Check for overlapping leaves
		$overlappingLeave = DB::table('leaves')
			->where('user_id', auth()->user()->id)
			->where(function($query) use ($request) {
				$query->whereBetween('start_date', [$request->start_date, $request->end_date])
					->orWhereBetween('end_date', [$request->start_date, $request->end_date])
					->orWhere(function($q) use ($request) {
						$q->where('start_date', '<=', $request->start_date)
							->where('end_date', '>=', $request->end_date);
					});
			})
			->whereNull('deleted_at')
			->first();
		
		if ($overlappingLeave) {
			return redirect()->back()
				->withInput()
				->with('error', 'You already have a leave request for this date range.');
		}
		
		// Create leave record
		DB::table('leaves')->insert([
			'user_id' => auth()->user()->id,
			'leavetype_id' => $request->leavetype_id,
			'start_date' => $request->start_date,
			'end_date' => $request->end_date,
			'status' => 'p', // Default status
			'created_at' => now(),
			'updated_at' => now()
		]);
		
		return redirect()->route('apply-leave')
			->with('success', 'Leave application submitted successfully!');
	}
	
	public function approveLeave($id) {
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Check if user is company admin
		$userRoles = \Session::get('loggedInUserRoles', []);
		$isCompanyAdmin = in_array('3', $userRoles);
		
		if (!$isCompanyAdmin) {
			return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
		}
		
		// Get active company ID
		$activeCompanyId = $this->getActiveCompanyId();
		
		// Get the leave request
		$leave = DB::table('leaves')
			->where('leaves.id', $id)
			->whereNull('leaves.deleted_at')
			->join('users', 'leaves.user_id', '=', 'users.id')
			->join('users_userroles', 'users.id', '=', 'users_userroles.user_id')
			->where('users_userroles.company_id', $activeCompanyId)
			->select('leaves.*')
			->first();
		
		if (!$leave) {
			return redirect()->route('dashboard')->with('error', 'Leave request not found or you do not have permission.');
		}
		
		// Update leave status to approved and store the approving user's ID
		DB::table('leaves')
			->where('id', $id)
			->update([
				'status' => 'a',
				'approved_user_id' => auth()->user()->id,
				'updated_at' => now()
			]);
		
		return redirect()->route('dashboard')->with('success', 'Leave request approved successfully!');
	}
	
	public function rejectLeave($id) {
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Check if user is company admin
		$userRoles = \Session::get('loggedInUserRoles', []);
		$isCompanyAdmin = in_array('3', $userRoles);
		
		if (!$isCompanyAdmin) {
			return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
		}
		
		// Get active company ID
		$activeCompanyId = $this->getActiveCompanyId();
		
		// Get the leave request
		$leave = DB::table('leaves')
			->where('leaves.id', $id)
			->whereNull('leaves.deleted_at')
			->join('users', 'leaves.user_id', '=', 'users.id')
			->join('users_userroles', 'users.id', '=', 'users_userroles.user_id')
			->where('users_userroles.company_id', $activeCompanyId)
			->select('leaves.*')
			->first();
		
		if (!$leave) {
			return redirect()->route('dashboard')->with('error', 'Leave request not found or you do not have permission.');
		}
		
		// Update leave status to rejected
		DB::table('leaves')
			->where('id', $id)
			->update([
				'status' => 'rejected',
				'updated_at' => now()
			]);
		
		return redirect()->route('dashboard')->with('success', 'Leave request rejected successfully!');
	}
	
	public function superAdminDashboard(){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}

		// Get all database tables
		$databaseName = DB::connection()->getDatabaseName();
		$tables = DB::select("SHOW TABLES");
		
		// Get table name key (it's usually like 'Tables_in_database_name')
		$tableKey = 'Tables_in_' . $databaseName;
		
		$tableData = [];
		
		foreach($tables as $table) {
			$tableName = $table->$tableKey;
			
			// Skip migrations table
			if($tableName === 'migrations') {
				continue;
			}
			
			try {
				// Get record count
				$count = DB::table($tableName)->count();
				
				// Get table size (optional, for MySQL)
				$size = null;
				try {
					$sizeResult = DB::selectOne("
						SELECT 
							ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb
						FROM information_schema.TABLES 
						WHERE table_schema = ? 
						AND table_name = ?
					", [$databaseName, $tableName]);
					
					if($sizeResult) {
						$size = $sizeResult->size_mb;
					}
				} catch(\Exception $e) {
					// Size calculation failed, continue without it
				}
				
				$tableData[] = [
					'name' => $tableName,
					'count' => $count,
					'size' => $size
				];
			} catch(\Exception $e) {
				// If counting fails, still add the table with error
				$tableData[] = [
					'name' => $tableName,
					'count' => 'Error',
					'size' => null
				];
			}
		}
		
		// Sort by table name
		usort($tableData, function($a, $b) {
			return strcmp($a['name'], $b['name']);
		});
		
		// Calculate totals
		$totalTables = count($tableData);
		$totalRecords = 0;
		foreach($tableData as $table) {
			if(is_numeric($table['count'])) {
				$totalRecords += $table['count'];
			}
		}
		$totalSize = 0;
		foreach($tableData as $table) {
			if($table['size'] !== null && is_numeric($table['size'])) {
				$totalSize += $table['size'];
			}
		}
		
		return view('users.super-admin-dashboard', compact('tableData', 'totalTables', 'totalRecords', 'totalSize', 'databaseName'));	
    	
    }

    public function profile(){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		$user = auth()->user()->load(['city', 'country']);
		$countries = Country::orderBy('title', 'asc')->get();
		$cities = City::orderBy('title', 'asc')->get();
		
		return view('users.profile', compact('user', 'countries', 'cities'));	
    	
    }

    public function updateProfile(Request $request){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		$user = auth()->user();
		
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'phone' => 'nullable|string|max:255',
			'country_id' => 'nullable|exists:countries,id',
			'city_id' => 'nullable|exists:cities,id',
			'date_of_birth' => 'nullable|date',
			'cnic' => 'nullable|string|max:255',
			'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);
		
		// Update user fields
		$user->title = $validated['title'];
		$user->phone = $validated['phone'] ?? null;
		$user->country_id = $validated['country_id'] ?? null;
		$user->city_id = $validated['city_id'] ?? null;
		$user->date_of_birth = $validated['date_of_birth'] ?? null;
		$user->cnic = $validated['cnic'] ?? null;
		
		// Handle photo upload
		if ($request->hasFile('photo')) {
			$file = $request->file('photo');
			$destinationPath = public_path('users/' . $user->id);
			
			// Create directory if it doesn't exist
			if (!File::exists($destinationPath)) {
				File::makeDirectory($destinationPath, 0755, true);
			}
			
			// Delete old photo if exists
			if ($user->photo && File::exists($destinationPath . '/' . $user->photo)) {
				File::delete($destinationPath . '/' . $user->photo);
			}
			
			// Generate unique filename
			$filename = time() . '_' . $file->getClientOriginalName();
			
			// Move uploaded file
			$file->move($destinationPath, $filename);
			
			// Update photo
			$user->photo = $filename;
		}
		
		$user->save();
		
		return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    	
    }

    public function markNotificationAsRead($id){
		// Check authentication
		if (!auth()->check()) {
			return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
		}
		
		$notification = auth()->user()->notifications()->find($id);
		
		if ($notification) {
			$notification->markAsRead();
			return response()->json(['success' => true]);
		}
		
		return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    }

    public function markAllNotificationsAsRead(){
		// Check authentication
		if (!auth()->check()) {
			return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
		}
		
		auth()->user()->unreadNotifications->markAsRead();
		
		return response()->json(['success' => true]);
    }

    public function switchCompany(Request $request, $companyId){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}
		
		// Get user's company IDs from session
		$companyIds = \Session::get('loggedInUserCompanies', []);
		
		// If no companies in session, get from user_userroles
		if (empty($companyIds)) {
			$userRoles = User_Userrole::where('user_id', auth()->user()->id)->get();
			$companyIds = $userRoles->pluck('company_id')->unique()->toArray();
			\Session::put('loggedInUserCompanies', $companyIds);
		}
		
		// Verify the company belongs to the user
		if (!in_array($companyId, $companyIds)) {
			return redirect()->back()->with('error', 'You do not have access to this company.');
		}
		
		// Set the selected company as the first in the array (active company)
		$companyIds = array_values(array_diff($companyIds, [$companyId]));
		array_unshift($companyIds, $companyId);
		\Session::put('loggedInUserCompanies', $companyIds);
		
		return redirect()->back()->with('success', 'Company switched successfully!');
    }

    public function settings(){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}

		// Get active company ID (currently selected company)
		$activeCompanyId = $this->getActiveCompanyId();
		
		if (!$activeCompanyId) {
			return redirect()->route('dashboard')->with('error', 'No company found. Please contact administrator.');
		}

		// Get the active company
		$defaultCompany = Company::find($activeCompanyId);

		if (!$defaultCompany) {
			return redirect()->route('dashboard')->with('error', 'Company not found.');
		}

		// Get all active modules (status = 1)
		$modules = Module::where('status', 1)->orderBy('title', 'asc')->get();

		// Get enabled modules for this company
		$enabledModuleIds = Company_Module::where('company_id', $defaultCompany->id)
			->pluck('module_id')
			->toArray();

		// Get company settings
		$companySettings = CompanySetting::where('company_id', $defaultCompany->id)->first();

		// Get countries for calendar country dropdown
		$countries = Country::orderBy('title', 'asc')->get();

		return view('users.settings', compact('defaultCompany', 'modules', 'enabledModuleIds', 'companySettings', 'countries'));	
    	
    }

    public function updateSettings(Request $request){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}

		// Get active company ID (currently selected company)
		$activeCompanyId = $this->getActiveCompanyId();
		
		if (!$activeCompanyId) {
			return redirect()->route('dashboard')->with('error', 'No company found. Please contact administrator.');
		}

		// Get the active company
		$defaultCompany = Company::find($activeCompanyId);

		if (!$defaultCompany) {
			return redirect()->route('dashboard')->with('error', 'Company not found.');
		}

		// Validate request
		$validated = $request->validate([
			'modules' => 'nullable|array',
			'modules.*' => 'exists:modules,id',
			'check_in_time' => 'nullable|date_format:H:i',
			'check_out_time' => 'nullable|date_format:H:i',
			'grace_period' => 'nullable|string|in:no-grace,5-min,10-min,15-min,30-min',
			'working_days' => 'nullable|array',
			'break_time' => 'nullable|integer',
			'calendar_country_id' => 'nullable|exists:countries,id',
			'year_start_date' => 'nullable|date',
			'casual_leaves' => 'nullable|integer|min:0',
			'sick_leaves' => 'nullable|integer|min:0',
			'emergency_leaves' => 'nullable|integer|min:0',
			'maternity_leaves' => 'nullable|integer|min:0',
			'paternity_leaves' => 'nullable|integer|min:0',
			'bereavement_leave' => 'nullable|integer|min:0',
			'compensation_leaves' => 'nullable|integer|min:0',
		]);

		// Use database transaction to ensure data integrity
		DB::beginTransaction();
		
		try {
		// Handle module settings
		$selectedModuleIds = $request->input('modules', []);
			
			// Ensure it's an array
			if (!is_array($selectedModuleIds)) {
				$selectedModuleIds = [];
			}
			
			// Delete existing modules for this company
		Company_Module::where('company_id', $defaultCompany->id)->delete();
			
			// Create new module associations
		if (!empty($selectedModuleIds)) {
			foreach ($selectedModuleIds as $moduleId) {
					// Validate module ID is numeric
					if (is_numeric($moduleId)) {
				Company_Module::create([
					'company_id' => $defaultCompany->id,
							'module_id' => (int)$moduleId
				]);
					}
			}
		}

		// Handle company settings
		$companySettings = CompanySetting::where('company_id', $defaultCompany->id)->first();
		
		$settingsData = [
			'company_id' => $defaultCompany->id,
			'check_in_time' => $request->input('check_in_time'),
			'check_out_time' => $request->input('check_out_time'),
			'grace_period' => $request->input('grace_period'),
			'working_days' => $request->input('working_days', []),
			'break_time' => $request->input('break_time'),
			'calendar_country_id' => $request->input('calendar_country_id'),
			'year_start_date' => $request->input('year_start_date'),
			'casual_leaves' => $request->input('casual_leaves'),
			'sick_leaves' => $request->input('sick_leaves'),
			'emergency_leaves' => $request->input('emergency_leaves'),
			'maternity_leaves' => $request->input('maternity_leaves'),
			'paternity_leaves' => $request->input('paternity_leaves'),
			'bereavement_leave' => $request->input('bereavement_leave'),
			'compensation_leaves' => $request->input('compensation_leaves'),
		];

		if ($companySettings) {
			$companySettings->update($settingsData);
		} else {
			CompanySetting::create($settingsData);
		}

			// Commit transaction
			DB::commit();

		return redirect()->route('settings')->with('success', 'Settings updated successfully!');
			
		} catch (\Exception $e) {
			// Rollback transaction on error
			DB::rollBack();
			
			return redirect()->route('settings')->with('error', 'Failed to update settings: ' . $e->getMessage());
		}
    	
    }

    public function payments(){
		// Check authentication
		if (!auth()->check()) {
			return redirect()->route('login')->with('error', 'Please login to access this page.');
		}

		// Get active company ID (currently selected company)
		$activeCompanyId = $this->getActiveCompanyId();
		
		if (!$activeCompanyId) {
			return redirect()->route('dashboard')->with('error', 'No company found. Please contact administrator.');
		}

		// Get the active company
		$defaultCompany = Company::find($activeCompanyId);

		if (!$defaultCompany) {
			return redirect()->route('dashboard')->with('error', 'Company not found.');
		}

		// Get all invoices for this company with related data
		$invoices = Invoice::where('company_id', $defaultCompany->id)
			->with(['subscriptionPlan', 'subscription', 'discount', 'payment'])
			->orderBy('invoice_date', 'desc')
			->paginate(15);

		return view('users.payments', compact('defaultCompany', 'invoices'));	
    	
    }

	protected function getActiveCompanyId() {
		// Get user's company IDs from session
		$companyIds = \Session::get('loggedInUserCompanies', []);
		
		// If no companies in session, get from user_userroles
		if (empty($companyIds)) {
			$userRoles = User_Userrole::where('user_id', auth()->user()->id)->get();
			$companyIds = $userRoles->pluck('company_id')->unique()->toArray();
			\Session::put('loggedInUserCompanies', $companyIds);
		}
		
		// Return the first company ID (active company)
		return !empty($companyIds) ? $companyIds[0] : null;
	}
	
}
