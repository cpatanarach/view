<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function index(Request $request){
    	$search = $request->search;
    	if(Auth::user()->level == WEBMASTER){
            $user = User::where([['username','LIKE','%'.$search.'%'],['level', '<', WEBMASTER]])
    				->orWhere([['email','LIKE','%'.$search.'%'],['level', '<', WEBMASTER]])
    				->orWhere([['firstname','LIKE','%'.$search.'%'],['level', '<', WEBMASTER]])
    				->orWhere([['lastname','LIKE','%'.$search.'%'],['level', '<', WEBMASTER]])
    				->get();
    		return view('user.usermgmt')->with('users',$user)->with('searchEngine', $this->getSearchUserEngine());
    	}else{
    		return view('error404');
    	}
    }
    public function update(Request $request){
    	if(Auth::user()->level == WEBMASTER){
    		$user = User::findOrFail($request->ref);
    		$user->level = $request->ref2;
    		$user->save();
    		return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    	}else{
    		return view('error404');
    	}
    }
    public function destroy(Request $request){
    	if(Auth::user()->level == WEBMASTER){
    		$user = User::findOrFail($request->ref);
    		$user->delete();
 			return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ');
    	}else{
    		return view('error404');
    	}
    }
    protected function getSearchUserEngine(){
        $searchEngine = new \stdClass();
        $searchEngine->link = url('/usermanagement/index');
        $searchEngine->placeHolder = 'ค้นหาผู้ใช้งาน...';
        $searchEngine->inputName = 'search';
        $searchEngine->enable = true;
        return $searchEngine;
    }
}
