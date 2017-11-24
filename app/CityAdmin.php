<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityAdmin extends Model
{
	protected $table = 'city_admin';
	protected $primaryKey = 'city_id';
	protected function cityName(){
		return $this->belongsTo('App\CityAdmin','city_id','city_id');
	}    
}