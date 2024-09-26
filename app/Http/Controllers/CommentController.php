<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Requests\StoreCommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commenRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commenRepository = $commentRepository;
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $this->commenRepository->store($request);
        broadcast(new CommentPosted($comment))->toOthers();
        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'user' => $comment->user->username,
                'user_id' => $comment->user_id,
                'body' => $comment->comment,
                'post_id' => $comment->post_id,
            ]
        ]);
    }
}
