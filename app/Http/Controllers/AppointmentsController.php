<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\Service;
use App\Models\Session;
use App\Models\Appointment;
use App\Models\User;
use App\Models\User_Userrole;
use App\Models\Reminder;

use Illuminate\Support\Str;

class AppointmentsController extends Controller
{	

    public function __construct(Request $request){
        parent::__construct($request);
    }
	
	public function book(Request $request){
        $selectedService = explode(' at ', $request->post('selected_service'));
        $selectedSlot = explode(' to ', $request->post('selected_slot'));
        $customerName = $request->post('your_name');
        $customerEmail = $request->post('your_email');
        $customerPhone = $request->post('your_phone');
        $appointmentDate = $request->post('appointment_date');
        $isReminder = $request->post('is_reminder');
        if($isReminder == 'on'){
            $reminderOption = explode(' ', $request->post('reminder_option'))[0];
        }else{
            $reminderOption = '';
        }
        
        $companyId = Company::where('title', $selectedService[1])->first()->id;
        $serviceId = Service::where('title', $selectedService[0])->where('company_id', $companyId)->first()->id;
        $sessionId = Session::where('start_time', '<=', $selectedSlot[0])->where('service_id', $serviceId)->first()->id;
    
        $userCheck = User::where('email', $customerEmail)->first();
        
        if($userCheck == null){
            $newUser = new User();
            $newUser->title = $customerName;
            $newUser->slug = urlencode($customerName);
            $newUser->email = $customerEmail;
            $newUser->phone = $customerPhone;
            $newPass = Str::random(8);
			$newUser->password = Hash::make($newPass);
            $newUser->save();
            $userId = $newUser->id;

            $newRole = new User_Userrole();
            $newRole->user_id = $userId;
            $newRole->company_id = $companyId;
            $newRole->userrole_id = 2;
            $newRole->save();
        }else{
            $userId = $userCheck -> id;
        }

        $appointmentCheck = Appointment::where('company_id', $companyId)
                                        ->where('service_id', $serviceId)
                                        ->where('session_id', $sessionId)
                                        ->where('appointment_date', $appointmentDate)
                                        ->where('start_time', $selectedSlot[0])
                                        ->where('end_time', $selectedSlot[1])
                                        ->where('user_id', $userId)
                                        ->first();
        // dd($appointmentCheck);
        if($appointmentCheck == null){
            $app = new Appointment();
            $app->company_id = $companyId;
            $app->service_id = $serviceId;
            $app->session_id = $sessionId;
            $app->user_id    = $userId;
            $app->appointment_date = $appointmentDate;
            $app->start_time = $selectedSlot[0];
            $app->end_time = $selectedSlot[1];
            $app->appointmentstatus_id = 2;
            $app->save();
            $appId = $app->id;
            
            $reminder = new Reminder();
            $reminder->appointment_id = $appId;
            $reminder->min_before = $reminderOption;
            $reminder->save();
            echo "Appointment has been booked Successfully!";            
        }else{
            echo "Booking already exists or unable to book now!";
        }
    }
	
}
