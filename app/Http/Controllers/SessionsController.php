<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Service;
use App\Models\Session;
use App\Models\Company;
use App\Models\Country;
use App\Models\Category_Company;
use App\Models\Country_Company;

class SessionsController extends Controller
{	

    public function __construct(Request $request){
        parent::__construct($request);
    }
	
	public function getSessions($category, $slug, $service){
        
        if($this->getCategory() != null){
			$categoryDetail = Category::where('title', $this->getCategory())->first();
		}
		
		if($this->getCompany() != null){
			$companyDetail = Company::where('title', $this->getCompany())->first();
            $countries = Country_Company::where('company_id', $companyDetail->id)->get();
            $services = Service::where('category_id', $categoryDetail->id)->where('company_id', $companyDetail->id)->get();
            $countriesList = null;
            foreach($countries as $ct){
                $countriesList[$ct->id] = Country::where('id', $ct->country_id)->first()->title;
            }
            
            $allCats = Category_Company::leftJoin('categories', 'category_id', '=', 'categories.id')
                                    ->where('company_id', $companyDetail->id)
                                    ->get();
            $serviceDetails = Service::where('slug', $service)->first();

            $sessions = Session::where('service_id', $serviceDetails->id)
                                ->where('session_date', '>', date('Y-m-d'))
                                ->orderBy('session_date', 'asc')
                                ->get();
            
            return view('cms.sessions', compact( 'companyDetail', 'categoryDetail', 'allCats', 'serviceDetails', 'sessions', 'services', 'countriesList', 'slug'));
        }
    }
	
}
