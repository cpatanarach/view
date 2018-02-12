<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class changeModel extends Model
{
    protected $table = 'change_models';
    protected function user(){
    	return $this->belogsTo('App\User');
    }
}
