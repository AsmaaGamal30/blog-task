<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CommentController extends Controller
{
    use AuthorizesRequests;

    protected $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(StoreCommentRequest $request)
    {
        $this->authorize('comment', Post::class);
        $comment = $this->commentRepository->store($request);
        broadcast(new CommentPosted($comment))->toOthers();
        Log::info('Broadcasting comment:', ['comment' => $comment]);
        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'user' => $comment->user->username,
                'user_id' => $comment->user_id,
                'comment' => $comment->comment,
                'post_id' => $comment->post_id
            ]
        ]);
    }
}
