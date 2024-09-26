<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use AuthorizesRequests;
    protected $postRepository;


    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->index();
        if ($posts->isEmpty()) {
            session()->flash('fail', 'No posts available');
        }
        return view("home", compact("posts"));
    }


    public function show($id)
    {
        $post = $this->postRepository->show($id);
        if (!$post) {
            return abort(404, 'undefiend post');
        }
        return view("blog.show", compact("post"));
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postRepository->store($request->all());
        if (! $this->authorize('create', $post)) {
            return abort(403, "You are unaithorized");
        }
        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = $this->postRepository->show($id);
        if (!$post) {
            return abort(404, 'undefiend post');
        }
        return view("blog.update", compact("post"));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->postRepository->update($request, $id);
        if (!$post) {
            return abort(404, 'undefiend post');
        }
        if (! $this->authorize('update', $post)) {
            return abort(403, "You are unaithorized");
        }
        return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = $this->postRepository->show($id);

        if (!$post) {
            return abort(404, 'Undefined post');
        }

        if (! $this->authorize('delete', $post)) {
            return abort(403, "You are unauthorized");
        }

        $this->postRepository->delete($id);

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }

    public function search(Request $request)
    {
        $posts = $this->postRepository->search($request);
        return view('home', compact('posts'))->with('search',  $request->input('search'));
    }
}
