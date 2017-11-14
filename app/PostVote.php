<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
	use SoftDeletes;

	protected $table = "post_user_vote";
    protected $fillable = ['post_id', 'user_id', 'vote'];

    //morphedByMany
}
