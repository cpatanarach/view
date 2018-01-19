<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkData extends Model
{
    protected $table = 'link_data';
    protected function linkDown(){
    	return $this->hasMany('App\LinkDown', 'city_id','id');
    }
    protected function linkDownAMP(){
    	return $this->hasMany('App\LinkDownAMP','n_city2','city_name1');
    }
    protected function city(){
    	return $this->belongsTo('App\City','city_name','city_name');
    }
    protected function cityTel(){
        return $this->hasOne('App\CityTel', 'city_name1','city_name1');
    }
    protected function author(){
        return $this->hasMany('App\CityAuthor','linkdata_id','id');
    }
}