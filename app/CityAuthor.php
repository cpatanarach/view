<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
define('OFFICE', 1);
define('FAX', 2);
define('MOBILE', 3);
define('VOICE', 4);
define('VIDEO', 5);

class CityAuthor extends Model
{
    protected $table = 'city_authors';
    protected $fillable = ['name', 'linkdata_id', 'type', 'number'];
    protected function linkData(){
    	return $this->belongsTo('App\LinkData','linkdata_id','id');
    }
}
