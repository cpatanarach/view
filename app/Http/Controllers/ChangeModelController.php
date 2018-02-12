<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\changeModel;
use Validator;
use Auth;
class ChangeModelController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	return view('auth.emailchange');
    }
    public function change(Request $request){
    	$email = $this->EmailValidator($request->all());
    	if($email->passes()){
    		$ref = changeModel::updateOrCreate(['user_id' => Auth::user()->id],
    			['reference' => $request->email]);
    		return redirect()->back()->with('success', 'ระบบได้ส่งลิงก์ยืนยันไปยัง '. $request->email. ' แล้ว กรุณาตรวจสอบอีเมล์เพื่อยืนยันการเปลี่ยนแปลง');
    	}else{
    		return redirect()->back()->withErrors($email)->withInput();
    	}
    }
    protected function EmailValidator(array $data){
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
        ],[
        	'email.unique' => 'อีเมลนี้ถูกใช้แล้ว',
        ]);
    }
}
