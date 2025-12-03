<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User_Userrole;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Display a listing of the user's companies.
     */
    public function index()
    {
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
        }

        // Get companies - if no company IDs, return empty collection
        if (empty($companyIds)) {
            $companies = collect([]);
        } else {
            $companies = Company::whereIn('id', $companyIds)->orderBy('created_at', 'desc')->get();
        }

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        return view('companies.create');
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(Request $request)
    {
        
        // Check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'website' => 'required|url|max:255',
            'team_size' => 'required|integer|min:1',
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
        ]);
        
        try {
            DB::beginTransaction();

            // Generate slug from company name
            $slug = Str::slug($validated['title']);
            
            // Make slug unique if company already exists
            $originalSlug = $slug;
            $counter = 1;
            while (Company::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Create company
            $company = new Company();
            $company->title = $validated['title'];
            $company->slug = $slug;
            $company->description = $validated['description'];
            $company->website = $validated['website'];
            $company->team_size = $validated['team_size'];
            $company->founded = $validated['founded_year'];
            $company->save();

            // Attach current user to the company as Company Admin (userrole_id = 3)
            // with department Business Administration (department_id = 15)
            $userUserrole = new User_Userrole();
            $userUserrole->user_id = auth()->user()->id;
            $userUserrole->userrole_id = 3; // Company Admin
            $userUserrole->company_id = $company->id;
            $userUserrole->department_id = 15; // Business Administration
            $userUserrole->save();

            DB::commit();

            // Update session with new company
            $companyIds = \Session::get('loggedInUserCompanies', []);
            if (!in_array($company->id, $companyIds)) {
                $companyIds[] = $company->id;
                \Session::put('loggedInUserCompanies', $companyIds);
            }

            return redirect()->route('dashboard')
                ->with('success', 'Company created successfully! You have been assigned as Company Admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the error for debugging
            \Log::error('Company creation failed: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create company: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit($id)
    {
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
        }

        // Verify the company belongs to the user
        if (!in_array($id, $companyIds)) {
            return redirect()->route('companies.index')
                ->with('error', 'You do not have access to this company.');
        }

        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     */
    public function update(Request $request, $id)
    {
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
        }

        // Verify the company belongs to the user
        if (!in_array($id, $companyIds)) {
            return redirect()->route('companies.index')
                ->with('error', 'You do not have access to this company.');
        }

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'website' => 'required|url|max:255',
            'team_size' => 'required|integer|min:1',
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $company = Company::findOrFail($id);

            // Generate slug from company name if title changed
            if ($company->title != $validated['title']) {
                $slug = Str::slug($validated['title']);
                
                // Make slug unique if company already exists
                $originalSlug = $slug;
                $counter = 1;
                while (Company::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $company->slug = $slug;
            }

            // Update company
            $company->title = $validated['title'];
            $company->description = $validated['description'];
            $company->website = $validated['website'];
            $company->team_size = $validated['team_size'];
            $company->founded = $validated['founded_year'];
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $destinationPath = public_path('companies/' . $company->id);
                
                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                
                // Delete old photo if exists
                if ($company->photo && File::exists($destinationPath . '/' . $company->photo)) {
                    File::delete($destinationPath . '/' . $company->photo);
                }
                
                // Generate unique filename
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Move uploaded file
                $file->move($destinationPath, $filename);
                
                // Update photo
                $company->photo = $filename;
            }
            
            $company->save();

            return redirect()->route('companies.index')
                ->with('success', 'Company updated successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Company update failed: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update company: ' . $e->getMessage());
        }
    }
}

