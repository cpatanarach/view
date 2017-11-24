<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city_name';
    protected function newCityAdmin(){
    	return $this->hasOne('App\newCityAdmin','city_id','city_id');
    }
    protected function linkData(){
    	return $this->hasMany('App\LinkData','city_name','city_name');
    }
    protected function cityAdmin(){
    	return $this->hasOne('App\CityAdmin','city_id','city_id');
    }
}
