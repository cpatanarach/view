<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $fillable = ['gallery_id', 'filename',];
    protected function gallery(){
    	return $this->belongsTo('App\Gallery','gallery_id','id');
    }
    protected function cover(){
    	return $this->hasOne('App\galleryCover','images_id','id');
    }
}
