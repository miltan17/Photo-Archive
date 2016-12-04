<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * An user can upload many photos
    */
    public function photos(){
         return $this->hasMany('App\Photo');
    }

    /**
    * An user can upload many likes
    */
    public function likes(){
         return $this->hasMany('App\Like');
    }
}
