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
        $data = $request->all();
        $user = Auth::user();
    	if($profile->passes()){
            if($data['prefix'] == '0'){$data['prefix'] = $data['prefix-other'];}
            $user->username = $data['username'];
            $user->prefix = $data['prefix'];
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->phone = $data['phone'];
            $user->phone2 = $data['phone2'];
            $user->save();

            Log::info($request->ip().'['.$user->email.'] Change profile successful.');
    		return redirect()->back()->with('success','คุณได้ทำการปรับปรุงโปรไฟล์แล้ว');
    	}else{
    		return redirect()->back()->withErrors($profile)->withInput();
    	}
    }
    protected function profileValidator(array $data){
        return Validator::make($data, [
            'username' => 'required|max:13|min:13|unique:users,username,'.$data['ref'].',id',
            'prefix' => 'required|max:32',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|min:12|max:12',
            'phone2' => 'required|max:12',
        ],[
            'username.unique' => 'ข้อมูลนี้ถูกใช้งานแล้ว',
        ]);
    }
}
