<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'nsfw', 'cover_box', 'pictures', 'videos'];

	protected $dates = ['deleted_at'];

    public function posts()
    {
    	return $this->hasMany('App\Post');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }
}
