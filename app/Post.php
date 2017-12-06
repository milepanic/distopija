<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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

    // public function favoritedBy(User $user)
    // {
    //     return $this->favorites()->where('user_id', $user->id)->exists();
    // }

    public function votes()
    {
        return $this->belongsToMany('App\User', 'votes')->withPivot('vote');
    }

    public function votedBy(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->pluck('vote');
    }

    // Gets all posts which category the user did not block
    // Gets 'id' of where blocked = true from pivot table and shows posts which category does not have that 'id'
    public function scopeNotBlocked($query)
    {
        $blocked = Auth::user()
                    ->categories()
                    ->where('blocked', true)
                    ->get()
                    ->pluck(['id'])
                    ->toArray();

        return $query->whereNotIn('category_id', $blocked)
                    ->with(['comments.user', 'user', 'category', 'favorites', 'votes'])
                    ->withCount([
                        'favorites',
                        'votes as upvotes_count' => function ($query) {
                            $query->where('vote', 1);
                        },
                        'votes as downvotes_count' => function ($query) {
                            $query->where('vote', -1);
                        }
                    ]);
    }

    public function scopeFilter($query, $var)
    {
        switch ($var) {
            case 'new':
                return $query->latest();
                break;
            case 'top':
                // funkcija za top
                break;
            case 'original':
                return $query->where('original', true);
            // trending
            default:
                // funckija za trending
                break;
        }
    }
}
