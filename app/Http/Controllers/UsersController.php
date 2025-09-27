<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\User_Userrole;
use App\Models\Category; 
use App\Models\Country; 
use App\Models\Company;
use App\Models\Category_Company;
use App\Models\Country_Company;

class UsersController extends Controller
{

	public function signUpPosted(Request $request){
		$validated = $request->validate([
	        'company_name' => 'required',
	        'slug' => 'required',
			'category_id' => 'required',
			'country_id' => 'required',
	        'your_name' => 'required',
			'username' => 'required|email',
			'password' => 'required',
	    ]);
		$statusMessages = [];
		
		$checkUser = User::where('email', $request->post('username'))->first();
		if($checkUser != null){
			$userId = $checkUser->id;
		}else{
			$newUser = new User();
			$newUser->title = $request->post('your_name');
			$newUser->email = $request->post('username');
			$newUser->phone = $request->post('phone');
			$newUser->password = encryptPassword($request->post('password'));
			$newUser->status = 1;
			$newUser->save();
			$userId = $newUser->id;
			$statusMessages[] = 'User added successfully!';
		}

		$checkCompany = Company::where('slug', $request->post('slug'))
							   ->where('title', $request->post('company_name'))
							   ->first();
		if($checkCompany == null){
			$newCompany = new Company();
			$newCompany->title = $request->post('company_name');
			$newCompany->slug = $request->post('slug');
			$newCompany->save();
			$companyId = $newCompany->id;
			$statusMessages[] = 'Company Added successfully';
		}else{
			$companyId = $checkCompany->id;
		}

		$checkCategory = Category_Company::where('company_id', $companyId)
										 ->where('category_id', $request->post('category_id'))
										 ->first();
		if($checkCategory == null){
			$newCategory = new Category_Company();
			$newCategory->company_id = $companyId;
			$newCategory->category_id = $request->post('category_id');
			$newCategory->save();
			$statusMessages[] = 'Category Assigned Successfully';
		}

		$checkCountry = Country_Company::where('company_id', $companyId)
										 ->where('country_id', $request->post('country_id'))
										 ->first();
		if($checkCountry == null){
			$newCountry = new Country_Company();
			$newCountry->company_id = $companyId;
			$newCountry->country_id = $request->post('country_id');
			$newCountry->save();
			$statusMessages[] = 'Country Assigned Successfully';
		}

		$checkUserRole = User_Userrole::where('user_id', $userId)
									  ->where('userrole_id', 3)
									  ->where('company_id', $companyId)
									  ->first();
		if($checkUserRole == null){
			$newUserRole = new User_Userrole();
			$newUserRole->user_id = $userId;
			$newUserRole->userrole_id = 3;
			$newUserRole->company_id = $companyId;
			$newUserRole->save();
			$statusMessages[] = 'Userrole assigned successfully!';
		}

		return redirect('/sign-up')->with('success', implode(', ', $statusMessages));

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
					$userrole[] = $urd->userrole_id;
					if(\Session::get('loggedInUserRoles') && in_array('3', \Session::get('loggedInUserRoles'))){
						$companies[] = $urd->company_id;
					}
				}
				
				\Session::put('loggedInUserRoles', $userrole);
				\Session::put('loggedInUserCompanies', $companies);
				
				return redirect('dashboard');
    		}else{
    			return view('users.login')->with('error', 'Combination of Email Address and Password are not correct!');	
    		}
    	}else{
    		return view('users.login')->with('error', 'Invalid Email or not registered with us!');
    	}

    }

    public function logout(){
    	auth()->logout();
    	return redirect('/login')->with('success', 'Successfully Logged Out!');
    }

	public function index(){
		return view('users.login');	
    }

    public function dashboard(){
		
		
		return view('users.dashboard');	
    	
    }

	
}
