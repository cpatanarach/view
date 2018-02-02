<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkData;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    public function index(){
        return view('welcome');
    }
    public function home(){
        return view('home');
    }
    public function calTime(){
        return view('cal_time');
    }

    //Test Query
    public function testQuery(){
        //$linkData = LinkData::distinct()->get(['city_name']);
    }
}
