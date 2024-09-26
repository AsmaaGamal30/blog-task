<?php

namespace App\Repositories;

use App\Http\Interfaces\PostInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostRepository implements PostInterface
{

    public function index()
    {
        $posts = Post::orderByDesc("created_at")->with('user')->paginate(10);

        return $posts;
    }




    public function show($id)
    {
        $post = Post::with(['user', 'comments'])->findOrFail($id);

        return $post;
    }

    public function store($request)
    {
        $imagePath = null;

        if (isset($request['image']) && $request['image']->isValid()) {
            $image = $request['image'];
            $imagePath = $image->store('images', 'public');
        }

        $post = Post::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'image' => $imagePath,
            'user_id' => $request['user_id'],
        ]);
        return $post;
    }

    public function update($request, $id)
    {
        $post = Post::findOrFail($id);


        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $request['image'] = $imagePath;
        }

        $post->update($request->only(['title', 'body', 'image']));
        return $post;
    }

    public function delete($id)
    {

        $post = Post::findOrFail($id);
        return $post->delete();
    }

    public function search($request)
    {
        $search = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%')
            ->paginate(10);
        return $posts;
    }
}