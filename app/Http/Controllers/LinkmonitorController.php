<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\LinkDown;
use App\LinkDownAMP;
use App\CalTime;
use DateTime;
use App\User;
use App\CheckProgram;
use App\viewLInkAPI;
use App\City;
use Counter;
class LinkmonitorController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	if(Auth::user()->level >= SUPERUSER){
    		return view('link.home');
    	}else{
    		return view('error404');
    	}
    }
    public function linkmonitor(Request $data){
        Counter::showAndCount('home');
    	if(Auth::user()->level >= SUPERUSER){
    		if(!isset($data->list)){$data->list=25;}
    		if(!isset($data->search)){$data->search='';}
    		//Time
    		$timeNow = new DateTime();
    		$bdYear = $timeNow->format('Y')+543;
			$dSecond = new DateTime($bdYear.'-'.$timeNow->format('m-d H:i:s'));
			$dSecond->modify("-1 minutes");
    		$Link386_Count = 0;$Link72_Count = 0;
    		if($data->list == 'all'){
    			$LinkDown = LinkDown::where([
    									['job_down','=','OFF'],
    									['date_down','=', $dSecond->format('Y-m-d')],
    									['time_down','<=', $dSecond->format('H:i:s')],
    									['job_user','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','<', $dSecond->format('Y-m-d')],
    									['job_user','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','=', $dSecond->format('Y-m-d')],
    									['time_down','<=', $dSecond->format('H:i:s')],
    									['n_city2','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','<', $dSecond->format('Y-m-d')],
    									['n_city2','LIKE','%'.$data->search.'%'],
    								])->get();            
    			$pageNumber = false;
    		}else{
    			$LinkDown = LinkDown::where([
    									['job_down','=','OFF'],
    									['date_down','=', $dSecond->format('Y-m-d')],
    									['time_down','<=', $dSecond->format('H:i:s')],
    									['job_user','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','<', $dSecond->format('Y-m-d')],
    									['job_user','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','=', $dSecond->format('Y-m-d')],
    									['time_down','<=', $dSecond->format('H:i:s')],
    									['n_city2','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','<', $dSecond->format('Y-m-d')],
    									['n_city2','LIKE','%'.$data->search.'%'],
    								])->orderBy('city_id','ASC')->paginate($data->list);
    			//$LinkDown->appends(['list' => $data->list])->links();
    			//$LinkDown->appends(['search' => $data->search])->links();
                //$LinkDown->appends(['speaker' => $data->speaker])->links();
                //$LinkDown->appends(['soundtype' => $data->soundtype])->links();
                //$LinkDown->appends(['sound_ref' => $data->sound_ref])->links();
                $LinkDown->appends(request()->input())->links();
    			$pageNumber = true;
    			$perPage = $LinkDown->perPage();
    			$currentPage = $LinkDown->currentPage();
    		}
    		//for Count
    							$LinkDown2 = LinkDown::where([
    									['job_down','=','OFF'],
    									['date_down','=', $dSecond->format('Y-m-d')],
    									['time_down','<=', $dSecond->format('H:i:s')],
    									['job_user','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','<', $dSecond->format('Y-m-d')],
    									['job_user','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','=', $dSecond->format('Y-m-d')],
    									['time_down','<=', $dSecond->format('H:i:s')],
    									['n_city2','LIKE','%'.$data->search.'%'],
    								])->orWhere([
    									['job_down','=','OFF'],
    									['date_down','<', $dSecond->format('Y-m-d')],
    									['n_city2','LIKE','%'.$data->search.'%'],
    								])->get();
    		//End for Count
    		foreach ($LinkDown2 as $key => $value72) {
    			if($value72->linkData->id < 73) $Link72_Count++;
    		}
    		foreach ($LinkDown2 as $key => $value386) {
    			if($value386->linkData->id > 72) $Link386_Count++;
    		}
            //Program Check
            $chkPG = CheckProgram::where('app_name','=','Link_M')->first();
            $chkProgram = CalTime::getBasicFormatTimeDown($chkPG->time_chk, $chkPG->date_chk);
            

    		return view('link.monitor')->with('linkDown', $LinkDown)->with('pageNumber', $pageNumber)->with('perPage',$data->list)->with('Link72_Count',$Link72_Count)->with('Link386_Count',$Link386_Count)->with('search',$data->search)->with('speaker', $data->speaker)->with('soundtype', $data->soundtype)->with('programStatus', $chkProgram);
    	}else{
    		return view('error404');
    	}
    }

    public function linkmonitorAmp(Request $data){
        if(Auth::user()->level >= SUPERUSER){
            if(!isset($data->list)){$data->list=25;}
            if(!isset($data->search)){$data->search='';}
            //Time
            $timeNow = new DateTime();
            $bdYear = $timeNow->format('Y')+543;
            $dSecond = new DateTime($bdYear.'-'.$timeNow->format('m-d H:i:s'));
            $dSecond->modify("-1 minutes");
            if($data->list == 'all'){
                $LinkDown = LinkDownAMP::where([
                                        ['job_down','=','OFF'],
                                        ['date_down','=', $dSecond->format('Y-m-d')],
                                        ['time_down','<=', $dSecond->format('H:i:s')],
                                        ['job_user','LIKE','%'.$data->search.'%'],
                                    ])->orWhere([
                                        ['job_down','=','OFF'],
                                        ['date_down','<', $dSecond->format('Y-m-d')],
                                        ['job_user','LIKE','%'.$data->search.'%'],
                                    ])->orWhere([
                                        ['job_down','=','OFF'],
                                        ['date_down','=', $dSecond->format('Y-m-d')],
                                        ['time_down','<=', $dSecond->format('H:i:s')],
                                        ['n_city2','LIKE','%'.$data->search.'%'],
                                    ])->orWhere([
                                        ['job_down','=','OFF'],
                                        ['date_down','<', $dSecond->format('Y-m-d')],
                                        ['n_city2','LIKE','%'.$data->search.'%'],
                                    ])->get();
                $pageNumber = false;
            }else{
                $LinkDown = LinkDownAMP::where([
                                        ['job_down','=','OFF'],
                                        ['date_down','=', $dSecond->format('Y-m-d')],
                                        ['time_down','<=', $dSecond->format('H:i:s')],
                                        ['job_user','LIKE','%'.$data->search.'%'],
                                    ])->orWhere([
                                        ['job_down','=','OFF'],
                                        ['date_down','<', $dSecond->format('Y-m-d')],
                                        ['job_user','LIKE','%'.$data->search.'%'],
                                    ])->orWhere([
                                        ['job_down','=','OFF'],
                                        ['date_down','=', $dSecond->format('Y-m-d')],
                                        ['time_down','<=', $dSecond->format('H:i:s')],
                                        ['n_city2','LIKE','%'.$data->search.'%'],
                                    ])->orWhere([
                                        ['job_down','=','OFF'],
                                        ['date_down','<', $dSecond->format('Y-m-d')],
                                        ['n_city2','LIKE','%'.$data->search.'%'],
                                    ])->orderBy('city_id','ASC')->paginate($data->list);
                $LinkDown->appends(['list' => $data->list])->links();
                $LinkDown->appends(['search' => $data->search])->links();
                $pageNumber = true;
                $perPage = $LinkDown->perPage();
                $currentPage = $LinkDown->currentPage();
            }
            return view('link.monitorAmp')->with('linkDown', $LinkDown)->with('pageNumber', $pageNumber)->with('perPage',$data->list)->with('search',$data->search);
        }else{
            return view('error404');
        }
    }
}