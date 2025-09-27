<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SlotsController extends Controller
{	

    public function __construct(Request $request){
        parent::__construct($request);
    }
	
	public function availableSlots(Request $request){
		$companyId = parent::getCompanyId();

        
		// return view('cms.index');	
    }

	
}
