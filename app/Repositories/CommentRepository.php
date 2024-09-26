<?php

namespace App\Repositories;

use App\Events\CommentPosted;
use App\Http\Interfaces\CommentInterface;
use App\Models\Comment;

class CommentRepository implements CommentInterface
{
    public function store($request)
    {
        $comment = Comment::create($request->only(['comment', 'user_id', 'post_id']));
        return $comment;
    }
}
