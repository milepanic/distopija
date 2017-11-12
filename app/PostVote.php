<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    protected $fillable = ['post_id', 'user_id', 'vote', 'favorite'];
    protected $table = "post_user_vote";
    public $timestamps = false;
}
