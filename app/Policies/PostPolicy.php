<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function before($user, $ability)
    {
        if ($user->admin === 1)
            return true;
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function __construct()
    {
        //
    }
}
