<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public static function getStatuses()
    {
        return [0,1];
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
    public function counts()
    {
        return $this->hasMany('App\Post')->count();
    }

}
