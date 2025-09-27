<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Service;
use App\Models\Company;
use App\Models\Category_Company;

class ServicesController extends Controller
{	

    public function __construct(Request $request){
        parent::__construct($request);
    }
	
	public function getServices($category){
        
        $category = Category::where('slug', $category)->first();
        
        $companyDetail = $allCats = null;
		if($category != null){
            $categoryId = $category->id;
            $companyId = $this->getCompanyId();
            
            $services = Service::where('category_id', $categoryId)->where('company_id', $companyId)->get();
            
            
            return view('cms.services', compact('services', 'companyDetail', 'allCats'));
        }else{
            return redirect('/');
        }	
    }
	
}
