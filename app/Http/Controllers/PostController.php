<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
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


    public function show(Post $post)
    {
        return view("blog.show", compact("post"));
    }

    public function create()
    {
        return view("blog.create");
    }


    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $this->postRepository->store($request->all());

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        return view("blog.update", compact("post"));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {

        $this->authorize('update', $post);

        $this->postRepository->update($request, $post);

        return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $this->postRepository->delete($post);

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }

    public function search(Request $request)
    {
        $posts = $this->postRepository->search($request);
        return view('home', compact('posts'))->with('search',  $request->input('search'));
    }
}
