<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\LinkDown;
use App\Alert;
use Illuminate\Support\Facades\Log;

class AlertController extends Controller
{
    public function wait(Request $data){
    	$comment = '';
    	if($data->comment == 'other'){
    		$comment = $data->other;
    	}else{
    		$comment = $data->comment;
    	}
    	$linkDown = LinkDown::findOrFail($data->ref);
    	if((Auth::user()->level >= ADMIN) || (strpos($linkDown->linkData->job_name, Auth::user()->firstname))){
    		$alert = Alert::updateOrCreate(['link_down_id' => $linkDown->id],
    			['comment' => Auth::user()->firstname.' : '.$comment]);
            //push to history.
            Log::info($data->ip().'['.Auth::user()->email.']->Comment['.$comment.'] to LinkDown.Class['.$linkDown->id.' => '.$linkDown->n_city2.']');
       	}
    	return redirect()->back();
    }
}