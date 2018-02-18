<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkData;
use App\Gallery;
use Illuminate\Support\Facades\Log;
use Counter;

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
        $galleries = Gallery::where('publish','=',1)->orderBy('action', 'asc')->take(10)->get();
        Counter::showAndCount('home');
        return view('home')->with('galleries', $galleries)->with('galleries2', $galleries)->with('gCount', count($galleries));
    }
    public function contactUs(){
        return view('contact');
    }
    public function calTime(){
        return view('cal_time');
    }
    public function gallery($id){
        return view('error404');
    }
    public function galleries(Request $request){
        return view('error404');
    }

    //Test Query
    public function testQuery(){
        //$linkData = LinkData::distinct()->get(['city_name']);
    }
}
