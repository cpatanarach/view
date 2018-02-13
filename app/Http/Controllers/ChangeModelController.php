<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\changeModel;
use Validator;
use Auth;
use Mail;
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
    		$user = Auth::user();
            if(empty($user->changeEmail)){
                $newEmail = new changeModel();
                $newEmail->user_id = $user->id;
                $newEmail->reference = $request->email;
                $newEmail->save();
            }else{
                $user->changeEmail->reference = $request->email;
                $user->changeEmail->save();
            }
            //create form to send Email
            Mail::send('auth.mailToChange', ['user' => $user , 'ref' => bcrypt($user->changeEmail->reference)], function($message){

			    $message->to('oper.dol.it@gmail.com', 'OPER')->subject('Accept Email');
			});
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
