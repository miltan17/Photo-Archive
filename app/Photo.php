<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'imageName',
    ];

    /**
    * A photo can upload an user
    */
    public function user(){

    	return $this->belongsTo('App\User');
    }

    /**
    * A photo can upload many likes
    */
    public function likes(){
         return $this->hasMany('App\Like');
    }
}
