<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Auth\Access\HandlesAuthorization;


class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create posts.
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
        // ? Response::allow()
        // : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
        // ? Response::allow()
        // : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can comment on the post.
     */
    public function comment(User $user)
    {
        return true;
    }
}
