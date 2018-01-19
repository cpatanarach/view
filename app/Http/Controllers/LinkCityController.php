<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use App\CityTel;
use Auth;

class LinkCityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    protected function home(){
        if(Auth::user()->level >= SUPERUSER){
            //Get All Province
            $allProvince = City::all();
            //Create Search Engine Class
            $searchEngine = $this->getSearchProvineEngine();
            return view('link.home')->with('searchEngine', $searchEngine)->with('allProvince',$allProvince);
        }else{
            $USER = Auth::user()->newCityAdmin;
            if(!empty($USER)){
                return redirect(url('/linkCity') .'/'. $USER->city_id);
            }else{
                return view('error404');
            }
        }
    }
    protected function index($city_id){
    	$city = City::where('city_id','=',$city_id)->firstOrFail();
    	if(Auth::user()->level >= SUPERUSER || $city->newCityAdmin->user->id == Auth::user()->id){
    		return view('link.city')->with('city', $city)->with('activeMobileView',url('/linkCity/activeMobileView') .'/'. $city_id);
    	}else{
    		return view('error404');
    	}
    }
    protected function mobileIndex($city_id){
        $city = City::where('city_id','=',$city_id)->firstOrFail();
        if(Auth::user()->level >= SUPERUSER || $city->newCityAdmin->user->id == Auth::user()->id){
            return view('link.cityActiveMobile')->with('city', $city);
        }else{
            return view('error404');
        }
    }
    protected function updateSpace(){
    	if(Auth::user()->level >= WEBMASTER){
    		$textResult = '';
    		$city_name = City::all();//get all data form table:city_name
    		//remove double space
    		foreach ($city_name as $key => $city) {
    			$city_tel = CityTel::where([
    				['city_name1', 'LIKE', '%'. $city->city_name. '%'],
    				['city_name1', '<>', $city->city_name],
    			])->get();
    			foreach ($city_tel as $key => $cityTel) {
    				$att = CityTel::findOrFail($cityTel->id);
    				$att->city_name = trim($att->city_name);
    				$att->timestamps = false;    				
    				$hasChanged = explode(" ", $cityTel->city_name1); 
    				if(empty($hasChanged[1]) && empty($hasChanged[2])) {
    					$hasChanged[1] = $hasChanged[3];
    				}else if(empty($hasChanged[1])){
    					$hasChanged[1] = $hasChanged[2];
    				}
    				$att->city_name1 = trim($hasChanged[0]).' '.trim($hasChanged[1]);
    				$att->save();
    		    	$textResult .= $hasChanged[0].":".$hasChanged[1]."</br>";
    			}   		
    		}
    		return $textResult;
    	}else{
    		return view('error404');
    	}
    }
    protected function updateNewCityTel(){
    	if(Auth::user()->level >= ADMIN || $city->newCityAdmin->user->id == Auth::user()->id){


    		return 'Test link is ok';
    	}else{
    		return view('error404');
    	}
    }
    protected function searchProvince(Request $data){
        //request input $data->province
        if(Auth::user()->level >= SUPERUSER){
            $searchEngine = $this->getSearchProvineEngine();
            $allProvince = City::where('city_name', 'LIKE', '%'.$data->province.'%')->get();
            return view('link.home')->with('allProvince', $allProvince)->with('searchEngine',$searchEngine);
        }else{
            return view('error404');
        }
    }
    protected function getSearchProvineEngine(){
        $searchEngine = new \stdClass();
        $searchEngine->link = url('/linkHome/search');
        $searchEngine->placeHolder = 'ค้นหาจังหวัด...';
        $searchEngine->inputName = 'province';
        $searchEngine->enable = true;
        return $searchEngine;
    }
}
