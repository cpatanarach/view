<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkDown extends Model
{
    protected $table = 'link_down';
    protected function linkData(){
    	return $this->belongsTo('App\LinkData','city_id','id');
    }
    protected function alert(){
        return $this->hasOne('App\Alert','link_down_id','id');
    }
}