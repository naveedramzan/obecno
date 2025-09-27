<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $category = null;
    private $company = null;

    public function __construct(Request $request){
        
        $serverNameRaw = explode('.', $request->server('SERVER_NAME'));
        if(count($serverNameRaw) > 2){
            $categoryName = $serverNameRaw[0];
            $this->setCategory($categoryName);    
        }
        
        if($request->slug != ''){
            $this->setCompany($request->slug);    
        } 

    }

    public function setCategory($categoryName){
        $categoryDetail = Category::where(['slug' => $categoryName])->first();
        $this->category = @$categoryDetail->title;
    }

    public function setCompany($companyName){
        $companyDetail = Company::where(['slug' => $companyName])->first();
        $this->company = @$companyDetail->title;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getCompany(){
        return $this->company;
    }

}
