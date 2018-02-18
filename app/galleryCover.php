<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class galleryCover extends Model
{
    protected $table = 'gallery_covers';
    protected $fillable = ['gallery_id','images_id',];
    protected function gallery(){
    	return $this->belongsTo('App\Gallery','gallery_id','id');
    }
    protected function image(){
    	return $this->belongsTo('App\Images','images_id','id');
    }
}
