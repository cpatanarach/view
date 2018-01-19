<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\CityAdmin;

class CityAdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    protected function edit($city_id){
    	if(Auth::user()->level >= ADMIN){
    		$adminInfo = CityAdmin::where('city_id', '=', $city_id)->first();
    		return view('cityAdmin.edit')->with('adminInfo', $adminInfo);
    	}else{
    		return view('error404');
    	}
    }
    protected function update(Request $request){
    	if(Auth::user()->level >= ADMIN){
    		$cityAdmin = CityAdmin::where('city_id', '=', $request->ref)->first();
    		$cityAdmin->name_admin = $request->name_admin;
    		$cityAdmin->tel_admin = $request->tel_admin;
            $cityAdmin->tel_admin2 = $request->tel_admin2;
    		$cityAdmin->status = $request->status;
    		$cityAdmin->timestamps = false;
    		$cityAdmin->save();
    		return redirect('/linkHome');
    	}else{
    		return view('error404');
    	}
    }
}
