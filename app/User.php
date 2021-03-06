<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
define('WEBMASTER', 8);
define('ADMIN', 6);
define('SUPERUSER', 4);
define('SENIOR', 2);
define('USER', 1);
define('GUEST', 0);

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'prefix', 'firstname', 'lastname', 'phone', 'phone2', 'email', 'level', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected function newCityAdmin(){
        return $this->hasOne('App\newCityAdmin','user_id','id');
    }
    protected function changeEmail(){
        return $this->hasOne('App\changeModel','user_id','id');
    }
}
