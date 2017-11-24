<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newCityAdmin extends Model
{
    protected $table = 'new_city_admins';
    protected function city(){
    	return $this->belongsTo('App\City','city_id','city_id');
    }
    protected function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}
