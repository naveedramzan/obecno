<?php
use Illuminate\Support\Facades\DB;

if (! function_exists('allSettings')) {
	function allSettings()
	{
		$settings = DB::table('settings')
					  ->get();
		$allSettings = [];
		foreach($settings as $s){
			$allSettings[$s->title] = $s->value;
		}

		return $allSettings;
	}
}

if (! function_exists('getRecordOnId')) {
	function getRecordOnId($field, $recordId)
	{
		$table = Str::plural(str_replace('_id', '', $field));
		$record = DB::table($table)
					->where('id', $recordId)
					->first();
		return $record;
	}
}

if (! function_exists('encryptPassword')) {
	function encryptPassword($pass)
	{
		return \bcrypt($pass);
	}
}

if (! function_exists('getPlural')) {
	function getPlural($title)
	{
		return \Illuminate\Support\Str::plural($title);
	}
}

if (! function_exists('getSingular')) {
	function getSingular($title)
	{
		return \Illuminate\Support\Str::singular($title);
	}
}

if(! function_exists('getCombo')) {
	function getCombo($table, $selected = null, $rename = null, $attributes = []){
		$text = str_replace('_', ' ', str_replace('_id', '', $rename));
		$attributeText = '';
		if($attributes != null){
			foreach($attributes as $key => $val){
				$attributeText .= " $key='$val'";
			}
		}
		if($table == 'parents'){
			$table = 'categories';
		}
		$attributes['class'] = 'form-control';
		if($table == 'slots'){
			$dataSet = DB::table($table)
					 ->orderBy('start_time', 'asc')
					 ->get();
		}else if($table == 'subscriptions'){
			$dataSet = DB::table($table)
					 ->orderBy('start_date', 'asc')
					 ->get();
		}else if($table == 'payments'){
			$dataSet = DB::table($table)
					 ->orderBy('payment_date', 'asc')
					 ->get();
		}else if($table == 'invoices'){
			$dataSet = DB::table($table)
					 ->orderBy('expiry_date', 'asc')
					 ->get();
		}else{
			$dataSet = DB::table($table)
					 ->orderBy('title', 'asc')
					 ->get();
		}
		$records[''] = "Select Value";
		
		foreach($dataSet as $ddl){
			if($table == 'slots'){
				$records[$ddl->id] = $ddl->start_time.' to '.$ddl->end_time;
			}else if($table == 'subscriptions'){
				$records[$ddl->id] = dateConverter($ddl->start_date).' to '.dateConverter($ddl->end_date);
			}else if($table == 'invoices'){
				$records[$ddl->id] = 'Inv: '.dateConverter($ddl->invoice_date).' - Exp: '.dateConverter($ddl->expiry_date);
			}else{
				$records[$ddl->id] = $ddl->title;
			}
			
		}
		return Form::select($rename, $records, $selected, $attributes);
	}
}

if (! function_exists('getCount')) {
	function getCount($table, $where = [])
	{
		$records = DB::table($table)
					
						->count();
		
		return $records;
	}
}

if (! function_exists('getResultOnQuery')) {
	function getResultOnQuery($query)
	{
		$records = DB::select(DB::raw($query) );
		return $records;
	}
}

if (! function_exists('dateConverter')) {
	function dateConverter($date, $format = 'd-M-Y')
	{	
		return date($format, strtotime($date));
	}
}

if(! function_exists('friendlyUrl')) {
	function friendlyURL($string){
		return strtolower(preg_replace("![^a-z0-9]+!i", "-",$string));
	}
}

if (! function_exists('allCompanies')) {
	function allCompanies()
	{
		$companies = DB::table('companies')
					  ->get();
		$allCompanies = [];
		foreach($companies as $c){
			$allCompanies[$c->slug] = $c->title;
		}
		return $allCompanies;
	}
}

if (! function_exists('allCategories')) {
	function allCategories()
	{
		$categories = getResultOnQuery("select ct.* from categories ct join categories_companies ct_cp on ct_cp.category_id = ct.id");
						
		$allCategories = [];
		foreach($categories as $c){
			$allCategories[$c->slug] = $c->title;
		}
		return $allCategories;
	}
}

if (! function_exists('getDomain')) {
	function getDomain()
	{
		$url = explode('.', url('/'));
		$newUrl = $url[count($url)-2].'.'.$url[count($url)-1];
		$newUrl = str_replace('http://', '', $newUrl);
		return $newUrl;
	}
}