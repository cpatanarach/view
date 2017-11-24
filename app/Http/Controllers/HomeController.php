<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkData;

class HomeController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    public function index()
    {
        return view('welcome');
    }
     public function calTime()
    {
        return view('cal_time')->with('menu_service','1');
    }

    //Test Query
    public function testQuery(){
        //$linkData = LinkData::distinct()->get(['city_name']);
        $linkData = $linkData = LinkData::all();
        return view('testQuery')->with('province', $linkData);
    }
}
