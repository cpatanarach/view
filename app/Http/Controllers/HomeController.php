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
        $galleries = Gallery::where('publish','=',1)->orderBy('action', 'desc')->take(10)->get();
        Counter::showAndCount('home');
        return view('home')->with('galleries', $galleries)->with('galleries2', $galleries);
    }
    public function contactUs(){
        return view('contact');
    }
    public function calTime(){
        return view('cal_time');
    }
    public function gallery($id){
        return view('gallery')->with('gallery', Gallery::findOrFail($id));
    }
    public function galleries(Request $request){
        $search = $request->search;
        $galleries = Gallery::where([['publish','=',1], ['title','LIKE','%'.$search.'%']])
                    ->orWhere([['publish','=',1], ['discription','LIKE','%'.$search.'%']])
                    ->orderBy('action', 'desc')->paginate(18);
        $galleries->appends(request()->input())->links();
        return view('galleries')->with('galleries', $galleries)->with('searchEngine', $this->getSearchGalleryEngine());
    }
    protected function getSearchGalleryEngine(){
        $searchEngine = new \stdClass();
        $searchEngine->link = url('/home/galleries');
        $searchEngine->placeHolder = 'ค้นหากิจกรรม...';
        $searchEngine->inputName = 'search';
        $searchEngine->enable = true;
        return $searchEngine;
    }

    //Test Query
    public function testQuery(){
        //$linkData = LinkData::distinct()->get(['city_name']);
    }
}
