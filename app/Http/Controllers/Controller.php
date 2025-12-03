<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;
use App\Models\User_Userrole;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $category = null;
    private $company = null;

    public function __construct(Request $request){
        
        // Public routes that don't require authentication
        $publicRoutes = [
            'login', 
            'sign-up', 
            '/', 
            'login', 
            'sign-up', 
            'forgot-password',
            'about-us',
            'product-features',
            'testing'
        ];
        
        // Check if current route is public
        $isPublicRoute = $request->routeIs('login') || 
                        $request->routeIs('sign-up') ||
                        $request->is('/') ||
                        $request->is('login') ||
                        $request->is('sign-up') ||
                        $request->is('forgot-password') ||
                        $request->is('about-us') ||
                        $request->is('product-features') ||
                        $request->is('testing');
        
        // If not a public route and user is not authenticated, redirect to login
        // Note: Middleware should handle this, but this is an additional safety check
        if (!$isPublicRoute && !auth()->check()) {
            // Don't abort here, let middleware handle the redirect
            // This check is just for additional safety
        }
        
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

    /**
     * Check if user is authenticated, redirect to logout if not (session expired).
     * This is a helper method for controllers to use.
     */
    protected function checkAuth()
    {
        if (!auth()->check()) {
            return redirect()->route('logout');
        }
        return null;
    }

    /**
     * Get the active company ID from session (first company in the array).
     * This is the currently selected/switched company.
     */
    protected function getActiveCompanyId()
    {
        if (!auth()->check()) {
            return null;
        }

        // Get user's company IDs from session
        $companyIds = \Session::get('loggedInUserCompanies', []);
        
        // If no companies in session, get from user_userroles
        if (empty($companyIds)) {
            $userRoles = User_Userrole::where('user_id', auth()->user()->id)->get();
            $companyIds = $userRoles->pluck('company_id')->unique()->toArray();
            \Session::put('loggedInUserCompanies', $companyIds);
        }

        // Return the first company ID (active/selected company)
        return !empty($companyIds) ? $companyIds[0] : null;
    }

    /**
     * Get all company IDs for the logged-in user.
     */
    protected function getUserCompanyIds()
    {
        if (!auth()->check()) {
            return [];
        }

        // Get user's company IDs from session
        $companyIds = \Session::get('loggedInUserCompanies', []);
        
        // If no companies in session, get from user_userroles
        if (empty($companyIds)) {
            $userRoles = User_Userrole::where('user_id', auth()->user()->id)->get();
            $companyIds = $userRoles->pluck('company_id')->unique()->toArray();
            \Session::put('loggedInUserCompanies', $companyIds);
        }

        return $companyIds;
    }

}
