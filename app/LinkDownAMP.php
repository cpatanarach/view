<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkDownAMP extends Model
{
    protected $table = 'link_down_amp';
    protected function linkData(){
    	return $this->belongsTo('App\LinkData','n_city2','city_name1');
    }
}
