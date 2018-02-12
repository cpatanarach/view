<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class changeModel extends Model
{
    protected $table = 'change_models';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'reference',];
    protected function user(){
    	return $this->belogsTo('App\User','user_id','id');
    }
}
