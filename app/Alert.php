<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\LinkDown;

define('WAIT', true);
define('UP', false);
class Alert extends Model
{
	protected $table = 'alerts';
	protected $fillable = ['link_down_id', 'comment'];
    protected function linkDown(){
    	return $this->belongsTo('App\LinkDown','link_down_id','id');
    }
    protected function isOwner($ref){
    	$linkDown = LinkDown::findOrFail($ref);
    	if((Auth::user()->level >= ADMIN) || (strpos($linkDown->linkData->job_name, Auth::user()->firstname))){
    		return true;
    	}else{
    		return false;
    	}
    }
    protected function hasComment($ref){
    	$linkDown = LinkDown::findOrFail($ref);
    	if(count($linkDown->alert) >= 1){
    		return true;
    	}else{
    		return false;
    	}
    }
}