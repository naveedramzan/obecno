<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Category_Company;
use App\Models\Country_Company;
use App\Models\Company;
use App\Models\Category;
use App\Models\Country;
use App\Models\Service;

class CmsController extends Controller
{	
	
	public function __construct(Request $request){
        parent::__construct($request);
    }

	public function aboutCompany(Request $request){
		$companyDetail = null;
		$countriesList = null;
		if($this->getCompany() != null){
			$companyDetail = Company::where('title', $this->getCompany())->first();
			$countries = Country_Company::where('company_id',$companyDetail->id)->get();
			foreach($countries as $count){
				$countriesList[] = Country::where('id', $count->country_id)->first()->title;
			}
			$services = Service::where('company_id', $companyDetail->id)->get();
			$slug = $request->slug;
		}

		$allCompaniesHomepage = Company::where('status', '1')->get();
		return view('cms.index', compact('companyDetail', 'countriesList', 'services', 'slug', 'allCompaniesHomepage'));	
	}

	public function index(Request $request){
		
		$allCompanies = null;
		$categoryDetail = null;
		$companyDetail = null;
		$countriesList = null;
		$services = null;
		$slug = null;
		
		if($this->getCategory() != null){
			$categoryDetail = Category::where('title', $this->getCategory())->first();
			$companies = Category_Company::where('category_id', $categoryDetail->id)
											->get();
											
			foreach($companies as $ac){
				$allCompanies[$ac->id] = Company::where('id', $ac->company_id)->first();
			}
		}
		
		if($this->getCompany() != null){
			$companyDetail = Company::where('title', $this->getCompany())->first();
			$countries = Country_Company::where('company_id',$companyDetail->id)->get();
			foreach($countries as $count){
				$countriesList[] = Country::where('id', $count->country_id)->first()->title;
			}
			$services = Service::where('category_id', $categoryDetail->id)->where('company_id', $companyDetail->id)->get();
			$slug = $request->slug;
		}

		$allCompaniesHomepage = Company::where('status', '1')->get();
		return view('cms.index', compact('allCompanies', 'categoryDetail', 'companyDetail', 'countriesList', 'services', 'slug', 'allCompaniesHomepage'));	
    }

	public function about(Request $request){
		return view('cms.about');	
    }
	
	public function features(Request $request){
		return view('cms.features');	
    }
}
