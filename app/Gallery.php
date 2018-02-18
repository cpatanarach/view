<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = ['title', 'discription', 'publish', 'action',];
    protected function images(){
    	return $this->hasMany('App\Images','gallery_id','id');
    }
    protected function cover(){
    	return $this->hasOne('App\galleryCover','gallery_id','id');
    }
}
