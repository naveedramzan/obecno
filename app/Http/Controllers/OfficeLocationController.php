<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeLocation;
use App\Models\Company;
use App\Models\Timezone;
use App\Models\City;
use App\Models\Country;
use App\Models\User_Userrole;
use Illuminate\Support\Facades\DB;

class OfficeLocationController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Display a listing of office locations for the logged-in user's company.
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

        $officeLocations = OfficeLocation::where('company_id', $activeCompanyId)
            ->with(['company', 'timezone', 'city', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('office-locations.index', compact('officeLocations'));
    }

    /**
     * Show the form for creating a new office location.
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
            return redirect()->route('office-locations.index')
                ->with('error', 'No company found for your account.');
        }

        // Get the active company
        $defaultCompany = Company::find($activeCompanyId);
        
        if (!$defaultCompany) {
            return redirect()->route('office-locations.index')
                ->with('error', 'No company found for your account.');
        }

        $timezones = Timezone::all();
        $countries = Country::all();
        $cities = City::all();

        return view('office-locations.create', compact('defaultCompany', 'timezones', 'countries', 'cities'));
    }

    /**
     * Store a newly created office location in storage.
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
            return redirect()->route('office-locations.index')
                ->with('error', 'No company found for your account.');
        }

        // Get the active company
        $defaultCompany = Company::find($activeCompanyId);
        
        if (!$defaultCompany) {
            return redirect()->route('office-locations.index')
                ->with('error', 'No company found for your account.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'lat_lon' => 'nullable|string|max:255',
            'timezone_id' => 'nullable|exists:timezones,id',
            'city_id' => 'nullable|exists:cities,id',
        ]);

        $validated['company_id'] = $defaultCompany->id;
        $validated['user_id'] = auth()->user()->id;

        OfficeLocation::create($validated);

        return redirect()->route('office-locations.index')
            ->with('success', 'Office location created successfully!');
    }

    /**
     * Show the form for editing the specified office location.
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
            return redirect()->route('office-locations.index')
                ->with('error', 'No company found for your account.');
        }

        $officeLocation = OfficeLocation::where('company_id', $activeCompanyId)
            ->findOrFail($id);

        // Get the company for this location (read-only)
        $company = $officeLocation->company;
        
        $timezones = Timezone::all();
        $countries = Country::all();
        $cities = City::all();

        return view('office-locations.edit', compact('officeLocation', 'company', 'timezones', 'countries', 'cities'));
    }

    /**
     * Update the specified office location in storage.
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
            return redirect()->route('office-locations.index')
                ->with('error', 'No company found for your account.');
        }

        $officeLocation = OfficeLocation::where('company_id', $activeCompanyId)
            ->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'lat_lon' => 'nullable|string|max:255',
            'timezone_id' => 'nullable|exists:timezones,id',
            'city_id' => 'nullable|exists:cities,id',
        ]);

        // Don't allow changing company_id
        $validated['company_id'] = $officeLocation->company_id;

        $officeLocation->update($validated);

        return redirect()->route('office-locations.index')
            ->with('success', 'Office location updated successfully!');
    }

    /**
     * Remove the specified office location from storage.
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
            return redirect()->route('office-locations.index')
                ->with('error', 'No company found for your account.');
        }

        $officeLocation = OfficeLocation::where('company_id', $activeCompanyId)
            ->findOrFail($id);

        $officeLocation->delete();

        return redirect()->route('office-locations.index')
            ->with('success', 'Office location deleted successfully!');
    }
}

