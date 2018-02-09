<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\City;
use App\newCityAdmin;

class newCityAdminController extends Controller
{
    function __construct(){
    	$this->middleware('auth');
    }
    /*########## Store Data ##########*/
    function store(Request $request){
    	if(Auth::user()->level == WEBMASTER){
    		$city = City::where('city_id','=',$request->ref)->firstOrFail();
    		if(!empty($request->ref2)){
    			if(empty($city->newCityAdmin)){
	    			$newCityAdmin = new newCityAdmin();
	    			$newCityAdmin->city_id = $city->city_id;
	    			$newCityAdmin->user_id = $request->ref2;
	    			$newCityAdmin->save();
    			}else{
    				$city->newCityAdmin->user_id = $request->ref2;
    				$city->newCityAdmin->save();
    			}
    			return redirect()->back()->with('success', '1');
    		}else{
    			$city->newCityAdmin->delete();
    			return redirect()->back()->with('success', '1');
    		}
    	}else{
    		return view('error404');
    	}
    }
}
