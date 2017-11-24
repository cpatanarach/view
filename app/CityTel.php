<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityTel extends Model
{
    protected $table = 'city_tel';
    protected function linkData(){
        return $this->belongsTo('App\LinkData', 'city_name1','city_name1');
    }
}
