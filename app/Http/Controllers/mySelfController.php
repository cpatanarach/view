<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;
use Validator;
use Auth;

class mySelfController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function showProfile(){
    	return view('user.self.profile');
    }
    public function updateProfile(Request $request){
    	$profile = $this->profileValidator($request->all());
    	if($profile->passes()){
    		return view('404');
    	}else{
    		return redirect()->back()->withErrors($profile)->withInput();
    	}
    }
    protected function profileValidator(array $data){
        return Validator::make($data, [
            'username' => 'required|max:13|min:13|unique:users',
            'prefix' => 'required|max:32',
        ]);
    }
}
