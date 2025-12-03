<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Userrole;
use App\Models\Userrole;
use App\Models\Company;
use App\Models\OfficeLocation;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Display a listing of employees for the logged-in user's company.
     */
    public function index()
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('dashboard')->with('error', 'No company found. Please contact administrator.');
        }

        // Get employees linked to the active company through users_userroles
        $employees = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
            $query->where('company_id', $activeCompanyId);
        })
        ->with(['userRoles.userrole', 'userRoles.department', 'city', 'country'])
        ->orderBy('id', 'desc')
        ->paginate(15);

        return view('employees.index', compact('employees'));
    }

    /**
     * Display attendance for a specific employee.
     */
    public function show($id, Request $request)
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('dashboard')->with('error', 'No company found. Please contact administrator.');
        }

        // Get employee and verify they belong to the company
        $employee = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
            $query->where('company_id', $activeCompanyId);
        })
        ->with(['userRoles.userrole', 'userRoles.department'])
        ->where('id', $id)
        ->first();

        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Employee not found or you do not have permission.');
        }

        // Get date filter (default to current month)
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        // Get attendance records for the employee within date range
        $attendanceRecords = DB::table('attendance')
            ->where('user_id', $id)
            ->whereDate('checkin', '>=', $startDate)
            ->whereDate('checkin', '<=', $endDate)
            ->orderBy('checkin', 'desc')
            ->paginate(20);

        return view('employees.show', compact('employee', 'attendanceRecords', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        // Get the active company
        $defaultCompany = Company::find($activeCompanyId);
        
        if (!$defaultCompany) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        $userroles = Userrole::all();
        $departments = Department::orderBy('title', 'asc')->get();
        $officeLocations = OfficeLocation::where('company_id', $defaultCompany->id)
            ->with(['city', 'city.country'])
            ->get();

        return view('employees.create', compact('defaultCompany', 'userroles', 'departments', 'officeLocations'));
    }

    /**
     * Show the form for uploading employees.
     */
    public function upload()
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        // Get the active company
        $defaultCompany = Company::find($activeCompanyId);
        
        if (!$defaultCompany) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        $officeLocations = OfficeLocation::where('company_id', $defaultCompany->id)
            ->with(['city'])
            ->get();

        $departments = Department::orderBy('title', 'asc')->get();

        return view('employees.upload', compact('defaultCompany', 'officeLocations', 'departments'));
    }

    /**
     * Process the uploaded CSV file.
     */
    public function uploadProcess(Request $request)
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        // Get the active company
        $defaultCompany = Company::find($activeCompanyId);
        
        if (!$defaultCompany) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'office_location_id' => 'required|exists:locations,id',
            'department_id' => 'nullable|exists:departments,id',
            'csv_file' => 'required|file|mimes:csv,txt|max:10240',
        ]);

        // Verify company_id matches user's company
        if ($validated['company_id'] != $defaultCompany->id) {
            return redirect()->route('employees.upload')
                ->with('error', 'Invalid company selected.');
        }

        $file = $request->file('csv_file');
        $officeLocation = OfficeLocation::find($validated['office_location_id']);
        
        if (!$officeLocation || $officeLocation->company_id != $defaultCompany->id) {
            return redirect()->route('employees.upload')
                ->with('error', 'Invalid office location selected.');
        }

        // Get city_id and country_id from office location
        $cityId = $officeLocation->city_id;
        $countryId = $officeLocation->city ? $officeLocation->city->country_id : null;

        try {
            $handle = fopen($file->getRealPath(), 'r');
            
            if ($handle === false) {
                return redirect()->route('employees.upload')
                    ->with('error', 'Unable to read the CSV file.');
            }

            // Read header row
            $headers = fgetcsv($handle);
            if (!$headers) {
                fclose($handle);
                return redirect()->route('employees.upload')
                    ->with('error', 'CSV file is empty or invalid.');
            }

            // Normalize headers (case-insensitive, trim whitespace)
            $headers = array_map('trim', array_map('strtolower', $headers));
            
            // Find column indices
            $nameIndex = array_search('employee name', $headers);
            $roleIndex = array_search('employee job role', $headers);
            $emailIndex = array_search('employee email', $headers);

            if ($nameIndex === false || $roleIndex === false || $emailIndex === false) {
                fclose($handle);
                return redirect()->route('employees.upload')
                    ->with('error', 'CSV file must contain columns: Employee Name, Employee Job Role, Employee Email');
            }

            $successCount = 0;
            $errorCount = 0;
            $errors = [];

            DB::beginTransaction();

            // Read data rows
            $rowNumber = 1;
            while (($row = fgetcsv($handle)) !== false) {
                $rowNumber++;
                
                if (count($row) < max($nameIndex, $roleIndex, $emailIndex) + 1) {
                    $errors[] = "Row $rowNumber: Insufficient columns";
                    $errorCount++;
                    continue;
                }

                $name = trim($row[$nameIndex]);
                $jobRole = trim($row[$roleIndex]);
                $email = trim($row[$emailIndex]);

                // Skip empty rows
                if (empty($name) && empty($email)) {
                    continue;
                }

                // Validate required fields
                if (empty($name)) {
                    $errors[] = "Row $rowNumber: Employee Name is required";
                    $errorCount++;
                    continue;
                }

                if (empty($email)) {
                    $errors[] = "Row $rowNumber: Employee Email is required";
                    $errorCount++;
                    continue;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Row $rowNumber: Invalid email format: $email";
                    $errorCount++;
                    continue;
                }

                if (empty($jobRole)) {
                    $errors[] = "Row $rowNumber: Employee Job Role is required";
                    $errorCount++;
                    continue;
                }

                try {
                    // Find or create userrole
                    $userrole = Userrole::where('title', $jobRole)->first();
                    if (!$userrole) {
                        $userrole = new Userrole();
                        $userrole->title = $jobRole;
                        $userrole->save();
                    }

                    // Find or create user
                    $user = User::where('email', $email)->first();
                    if (!$user) {
                        // Generate slug from name
                        $slug = Str::slug($name);
                        $originalSlug = $slug;
                        $counter = 1;
                        while (User::where('username', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $counter;
                            $counter++;
                        }

                        // Generate random password
                        $randomPassword = Str::random(12);

                        $user = new User();
                        $user->title = $name;
                        $user->email = $email;
                        $user->password = \Hash::make($randomPassword);
                        $user->username = $slug;
                        $user->city_id = $cityId;
                        $user->country_id = $countryId;
                        $user->save();
                    } else {
                        // Update city and country if user exists
                        $user->city_id = $cityId;
                        $user->country_id = $countryId;
                        $user->save();
                    }

                    // Use department from form dropdown
                    $departmentId = !empty($validated['department_id']) ? $validated['department_id'] : null;

                    // Check if user-userrole-company relationship already exists
                    $existingRelation = User_Userrole::where('user_id', $user->id)
                        ->where('company_id', $defaultCompany->id)
                        ->where('userrole_id', $userrole->id)
                        ->where('location_id', $officeLocation->id)
                        ->first();

                    if (!$existingRelation) {
                        // Create user-userrole relationship with company, location, and department
                        $userUserrole = new User_Userrole();
                        $userUserrole->user_id = $user->id;
                        $userUserrole->userrole_id = $userrole->id;
                        $userUserrole->company_id = $defaultCompany->id;
                        $userUserrole->location_id = $officeLocation->id;
                        $userUserrole->department_id = $departmentId;
                        $userUserrole->save();
                    }

                    $successCount++;
                } catch (\Exception $e) {
                    $errors[] = "Row $rowNumber: " . $e->getMessage();
                    $errorCount++;
                }
            }

            fclose($handle);

            DB::commit();

            $message = "Upload completed! Successfully processed $successCount employee(s).";
            if ($errorCount > 0) {
                $message .= " $errorCount error(s) occurred.";
                if (count($errors) > 0) {
                    $message .= " Errors: " . implode('; ', array_slice($errors, 0, 10));
                    if (count($errors) > 10) {
                        $message .= " and " . (count($errors) - 10) . " more.";
                    }
                }
            }

            return redirect()->route('employees.index')
                ->with('success', $message)
                ->with('upload_errors', $errors);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('employees.upload')
                ->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        // Get the active company
        $defaultCompany = Company::find($activeCompanyId);
        
        if (!$defaultCompany) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'userrole_id' => 'required|exists:userroles,id',
            'office_location_id' => 'nullable|exists:locations,id',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        // Get city_id and country_id from office location if selected
        $cityId = null;
        $countryId = null;
        
        if ($request->office_location_id) {
            $officeLocation = OfficeLocation::find($request->office_location_id);
            if ($officeLocation && $officeLocation->city) {
                $cityId = $officeLocation->city_id;
                $countryId = $officeLocation->city->country_id;
            }
        }

        // Generate slug from title
        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (User::where('username', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Generate random password
        $randomPassword = Str::random(12);

        // Create user
        $user = new User();
        $user->title = $validated['title'];
        $user->email = $validated['email'];
        $user->password = \Hash::make($randomPassword);
        $user->username = $slug;
        $user->city_id = $cityId;
        $user->country_id = $countryId;
        $user->save();

        // Create user-userrole relationship with company
        $userUserrole = new User_Userrole();
        $userUserrole->user_id = $user->id;
        $userUserrole->userrole_id = $validated['userrole_id'];
        $userUserrole->company_id = $defaultCompany->id;
        $userUserrole->location_id = $request->office_location_id;
        $userUserrole->department_id = $request->department_id;
        $userUserrole->save();

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully! Password: ' . $randomPassword);
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        $employee = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
            $query->where('company_id', $activeCompanyId);
        })->findOrFail($id);

        // Get the company and userrole from the relationship
        $userRole = $employee->userRoles()->where('company_id', $activeCompanyId)->with('department')->first();
        $company = $userRole ? Company::find($userRole->company_id) : null;
        
        if (!$company) {
            return redirect()->route('employees.index')
                ->with('error', 'Company not found for this employee.');
        }

        $userroles = Userrole::all();
        $departments = Department::orderBy('title', 'asc')->get();
        $officeLocations = OfficeLocation::where('company_id', $company->id)
            ->with(['city', 'city.country'])
            ->get();

        return view('employees.edit', compact('employee', 'company', 'userroles', 'departments', 'officeLocations', 'userRole'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, $id)
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        $employee = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
            $query->where('company_id', $activeCompanyId);
        })->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|max:255',
            'userrole_id' => 'required|exists:userroles,id',
            'office_location_id' => 'nullable|exists:locations,id',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        // Get city_id and country_id from office location if selected
        $cityId = null;
        $countryId = null;
        
        if ($request->office_location_id) {
            $officeLocation = OfficeLocation::find($request->office_location_id);
            if ($officeLocation && $officeLocation->city) {
                $cityId = $officeLocation->city_id;
                $countryId = $officeLocation->city->country_id;
            }
        }

        // Update user
        $employee->title = $validated['title'];
        $employee->email = $validated['email'];
        $employee->city_id = $cityId;
        $employee->country_id = $countryId;
        $employee->save();

        // Update user-userrole relationship
        $userRole = $employee->userRoles()->where('company_id', $activeCompanyId)->first();
        if ($userRole) {
            $userRole->userrole_id = $validated['userrole_id'];
            $userRole->location_id = $request->office_location_id;
            $userRole->department_id = $request->department_id;
            $userRole->save();
        }

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy($id)
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get active company ID (currently selected company)
        $activeCompanyId = $this->getActiveCompanyId();
        
        if (!$activeCompanyId) {
            return redirect()->route('employees.index')
                ->with('error', 'No company found for your account.');
        }

        $employee = User::whereHas('userRoles', function($query) use ($activeCompanyId) {
            $query->where('company_id', $activeCompanyId);
        })->findOrFail($id);

        // Delete user-userrole relationship for this company
        $employee->userRoles()->where('company_id', $activeCompanyId)->delete();

        // Note: We're not deleting the user itself, just the relationship
        // If you want to delete the user completely, uncomment the line below
        // $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee removed from company successfully!');
    }
}

