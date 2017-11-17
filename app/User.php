<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'slug'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withPivot('blocked', 'moderator');
    }

    public function messages()
    {
        return $this->belongsToMany('App\Message')->withPivot('reciever_id');
    }

    public function isBanned()
    {
        if($this->banned_until && Carbon::now() <= $this->banned_until)
            return true;
        else
            return false;
    }

    public function favoritePosts()
    {
        return $this->belongsToMany('App\Post', 'favorites');
    }

    public function postVote()
    {
        return $this->belongsToMany('App\Post', 'votes')->with('vote');
    }
}
