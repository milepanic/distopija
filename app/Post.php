<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;

    protected $fillable = ['content', 'original', 'category_id', 'user_id'];

    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites');
    }

    public function favoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function votes()
    {
        return $this->belongsToMany('App\User', 'votes')->with('vote');
    }
    // NIJE DOBRA VEZA, NE PREPOZNAJE SVOJ MODEL U PIVOT TABELI
    public function votedBy(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->pluck('vote');
    }
}
