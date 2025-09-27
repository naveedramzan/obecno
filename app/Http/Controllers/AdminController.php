<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
 
class AdminController extends Controller
{
    public function __construct(Request $request){
        parent::__construct($request);
    }

    public function adminSave(Request $request, $table){
        $dataField = [];
        foreach($request->all() as $key => $val){
            if($key != '_token'
            && strpos($key, 'photo') == false){
                $dataField[$key] = $val;
            }
        }
        
        DB::table($table)->insert($dataField);
        $recordId = DB::table($table)->orderBy('id', 'desc')->first()->id;
        
        if(strpos($key, 'photo') > -1){
            $file = $request->file($key);
            $destinationPath = public_path($table.'/'.$recordId);

            if(File::exists($destinationPath)){
                File::makeDirectory($destinationPath);
            }
            $query = "update $table set $key = '".$file->getClientOriginalName()."' where id = '$recordId'";
            DB::select(DB::raw($query));

            $file->move($destinationPath, $file->getClientOriginalName());
        }

        if($table == 'sprints'){
            return redirect('admin-edit-'.$table.'/'.$recordId)->with('success', 'Record added!');
        }else{
            return redirect('admin-list-'.$table)->with('success', 'Record added!');
        }
        
    }

    public function adminAdd($table){
        $notShow = ['id', 'created_at', 'updated_at', 'deleted_at'];

        $schema = DB::select(\DB::raw('SHOW COLUMNS FROM '.$table));
        return view('common.add', compact('table', 'schema', 'notShow'));
    }

    public function adminDelete(Request $request, $table, $id){
        DB::table($table)->where('id', $id)->delete();
        return redirect('admin-list-'.$table)->with('success', 'Record deleted!');
    }

    public function adminUpdate(Request $request, $table, $id){
        $dataField = [];
        foreach($request->all() as $key => $val){
            if($key != '_token'){
                $dataField[$key] = $val;
            }
        }
        DB::table($table)->where('id', $id)->update($dataField);

        if(strpos($key, 'photo') > -1){
            $file = $request->file($key);
            $destinationPath = public_path($table.'/'.$id);

            if(File::exists($destinationPath)){
                @File::makeDirectory($destinationPath);
            }
            $query = "update $table set $key = '".$file->getClientOriginalName()."' where id = '$id'";
            DB::select(DB::raw($query));

            $file->move($destinationPath, $file->getClientOriginalName());
        }

        if($table == 'sprints'){
            return redirect('edit-'.$table.'/'.$id)->with('success', 'Record updated!');
        }else{
            return redirect('admin-list-'.$table)->with('success', 'Record updated!');
        }
        
    }
    public function adminEdit(Request $request, $table, $id){

        $notShow = ['id', 'created_at', 'updated_at', 'deleted_at'];
        
        $record = DB::table($table)->where('id', $id)->first();
        $schema = DB::select(\DB::raw('SHOW COLUMNS FROM '.$table));
        return view('common.edit', compact('table', 'id', 'schema', 'record', 'notShow'));
    }

    public function adminList(Request $request, $table, $id = null)
    {
        if($table == 'employees'){
            $table = 'users';
            $join = 'employees';
        }
        $dataTable = DB::table($table);
        $dataTable->select("$table.*");
        if($request->input('textsearch')){
            if($table == 'attendance'){
                $dataTable->join('users', 'users.id', '=', $table.'.user_id');
                $dataTable->where('title', 'like', "%".$request->input('textsearch')."%");
            }else{
                $dataTable->where('title', 'like', "%".$request->input('textsearch')."%");
            }            
        }
        if($table == 'users' && $join == 'employees'){
            $dataTable->select([
                $table.'.*',
                'users_userroles.company_id'
            ]);
            $dataTable->join('users_userroles', function($join) use ($table) {
                $join->on($table.'.id', '=', 'users_userroles.user_id')
                     ->where('users_userroles.userrole_id', '=', 5);
            });
        }

        if(\Session::get('loggedInUserRoles') 
        && in_array('3', \Session::get('loggedInUserRoles'))
        && $table == 'companies'){
            $dataTable-> whereIn('id', \Session::get('loggedInUserCompanies'));
        }
        // dd($dataTable, \Session::get('loggedInUserCompanies'));
        if(\Session::get('loggedInUserRoles') 
        && in_array('3', \Session::get('loggedInUserRoles'))
        && in_array($table, ['cms', 'appointments', 'sessions', 'services'])){
            $dataTable-> whereIn('company_id', \Session::get('loggedInUserCompanies'));
        }
        if(\Session::get('loggedInUserRoles') 
        && in_array('3', \Session::get('loggedInUserRoles'))
        && $table == 'users'){
            $dataTable->join('users_userroles', 'users_userroles.user_id', '=', 'users.id')
                      ->where('users_userroles.userrole_id', $request->get('type'))
                      ->whereIn('company_id', \Session::get('loggedInUserCompanies'));
        }        
        
        if($id){
            switch($table){
                case 'users_sprints':
                    $dataTable->where('sprint_id', '=', $request->id);
                    break;
                case 'sprints':
                case 'users_projects':
                    $dataTable->where('project_id', '=', $request->id);
                    break;
                case 'attendance':
                    $dataTable->where('user_id', '=', $request->id);
                    break;
                case 'modulefunctions':
                    $dataTable->where('module_id', '=', $request->id);
                    break;
            }      
        }

        $listData = $dataTable->orderBy($table.'.id', 'desc')->paginate(allSettings()['adminPagination']);
        
        $schema = DB::select(\DB::raw('SHOW COLUMNS FROM '.$table));
        $fieldsList = [];
        
        foreach($schema as $s){
            switch($table){
                case 'cities':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'country_id';
                    break;
                case 'cms':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'description';
                    $fieldsList[] = 'company_id';
                    break;
                case 'companies':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'slug';
                    $fieldsList[] = 'photo';
                    $fieldsList[] = 'expertise';
                    $fieldsList[] = 'team_size';
                    break;
                case 'settings':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'value';
                    break;
                case 'employees':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'email';
                    $fieldsList[] = 'country_id';
                    $fieldsList[] = 'photo';
                    $fieldsList[] = 'company_id';
                    break;
                case 'users':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'email';
                    $fieldsList[] = 'country_id';
                    $fieldsList[] = 'photo';
                    $fieldsList[] = 'company_id';
                    break;
                case 'assets':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'company_id';
                    $fieldsList[] = 'assettype_id';
                    break;
                case 'services':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'company_id';
                    $fieldsList[] = 'category_id';
                    $fieldsList[] = 'photo';
                    break;
                case 'sessions':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'service_id';
                    $fieldsList[] = 'session_date';
                    $fieldsList[] = 'slot_duration';
                    $fieldsList[] = 'start_time';
                    $fieldsList[] = 'end_time';
                    break;
                case 'categories':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'slug';
                    $fieldsList[] = 'photo';
                    // $fieldsList[] = 'parent_id';
                    break;
                case 'slots':
                    $fieldsList[] = 'session_id';
                    $fieldsList[] = 'start_time';
                    $fieldsList[] = 'end_time';
                    break;
                case 'appointments':
                    $fieldsList[] = 'company_id';
                    $fieldsList[] = 'service_id';
                    $fieldsList[] = 'session_id';
                    $fieldsList[] = 'start_time';
                    $fieldsList[] = 'end_time';
                    $fieldsList[] = 'user_id';
                    $fieldsList[] = 'appointmentstatus_id';
                    break;
                case 'locations':
                    $fieldsList[] = 'company_id';
                    $fieldsList[] = 'phone';
                    $fieldsList[] = 'email';
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'timezone_id';
                    $fieldsList[] = 'user_id';
                    break;
                case 'employmenttypes':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'type';
                    $fieldsList[] = 'base_salary';
                    $fieldsList[] = 'hourly_salary';
                    $fieldsList[] = 'overtime';
                    break;
                case 'holidays':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'holiday_date';
                    $fieldsList[] = 'reoccuring';
                    break;
                case 'leaves':
                    $fieldsList[] = 'user_id';
                    $fieldsList[] = 'leavetype_id';
                    $fieldsList[] = 'start_date';
                    $fieldsList[] = 'end_date';
                    $fieldsList[] = 'status';
                    $fieldsList[] = 'approved_user_id';
                    break;
                case 'attendance':
                    $fieldsList[] = 'user_id';
                    $fieldsList[] = 'attendance_date';
                    $fieldsList[] = 'checkin';
                    $fieldsList[] = 'breakout';
                    $fieldsList[] = 'breakin';
                    $fieldsList[] = 'checkout';
                    break;
                case 'wages':
                    $fieldsList[] = 'user_id';
                    $fieldsList[] = 'wage_month';
                    $fieldsList[] = 'base_salary';
                    $fieldsList[] = 'overtime';
                    $fieldsList[] = 'bonus';
                    $fieldsList[] = 'pf_deduction';
                    $fieldsList[] = 'tax_deduction';
                    $fieldsList[] = 'other_deduction';
                    $fieldsList[] = 'final_payment';
                    $fieldsList[] = 'paid_via';
                    break;
                case 'invoices':
                    $fieldsList[] = 'company_id';
                    $fieldsList[] = 'subscriptionplan_id';
                    $fieldsList[] = 'subscription_id';
                    $fieldsList[] = 'discount_id';
                    $fieldsList[] = 'invoice_date';
                    $fieldsList[] = 'expiry_date';
                    $fieldsList[] = 'total_amount';
                    $fieldsList[] = 'any_discount';
                    $fieldsList[] = 'currency_id';
                    $fieldsList[] = 'final_payable';
                    $fieldsList[] = 'status';
                    break;
                case 'payments':
                    $fieldsList[] = 'invoice_id';
                    $fieldsList[] = 'payment_date';
                    $fieldsList[] = 'payment_method';
                    $fieldsList[] = 'transactionid';
                    $fieldsList[] = 'paid_amount';
                    $fieldsList[] = 'status';
                    break;
                case 'discounts':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'description';
                    $fieldsList[] = 'discount_type';
                    $fieldsList[] = 'value';
                    $fieldsList[] = 'start_date';
                    $fieldsList[] = 'end_date';
                    $fieldsList[] = 'subscriptionplan_id';
                    $fieldsList[] = 'status';
                    break;
                case 'subscriptions':
                    $fieldsList[] = 'company_id';
                    $fieldsList[] = 'subscriptionplan_id';
                    $fieldsList[] = 'start_date';
                    $fieldsList[] = 'end_date';
                    $fieldsList[] = 'referral_user_id';
                    $fieldsList[] = 'status';
                    break;
                case 'subscriptionplans':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'billing_cycle';
                    $fieldsList[] = 'price_per_cycle';
                    $fieldsList[] = 'status';
                    break;
                case 'subscriptionplanhistory':
                    $fieldsList[] = 'subscriptionplan_id';
                    $fieldsList[] = 'old_price';
                    $fieldsList[] = 'new_price';
                    break;
                case 'timezones':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'timezone';
                    break;
                case 'currencies':
                    $fieldsList[] = 'title';
                    $fieldsList[] = 'code';
                    $fieldsList[] = 'symbol';
                    break;
                default:
                    $fieldsList[] = 'title';
                    
                    break;
            }
        }
        $fieldsList = array_unique($fieldsList);
        
        return view('common.list', compact('listData', 'table', 'fieldsList', 'id'));    
    }
}
