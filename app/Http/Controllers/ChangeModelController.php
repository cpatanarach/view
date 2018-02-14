<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\User;
use App\changeModel;
use Validator;
use Auth;
use Mail;
use Illuminate\Support\Facades\Log;
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
                $user->changeEmail = $newEmail;
            }else{
                $user->changeEmail->reference = $request->email;
                $user->changeEmail->save();
            }
            //create form to send Email
            Mail::to($user->changeEmail->reference)
                ->send(new OrderShipped($user));
    		return redirect()->back()->with('success', 'ระบบได้ส่งลิงก์ยืนยันไปยัง '. $request->email. ' แล้ว กรุณาตรวจสอบอีเมล์เพื่อยืนยันการเปลี่ยนแปลง');
    	}else{
    		return redirect()->back()->withErrors($email)->withInput();
    	}
    }
    public function hasAccept(Request $request){
        $user = Auth::user();
        if(!empty($user->changeEmail->reference) && password_verify($user->changeEmail->reference, $request->ref)){
            Log::alert('['.$request->ip().']Change email from ' . $user->email . ' to ' . $user->changeEmail->reference);
            $user->email = $user->changeEmail->reference;
            $user->save();
            $user->changeEmail->delete();
            return view('auth.acceptemailchange');
        }else{
            return view('error404');
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
