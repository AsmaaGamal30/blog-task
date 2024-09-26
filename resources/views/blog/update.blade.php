@extends('layouts.layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')
    <div class="form-container">
        <h4>Update Post</h4>
        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="tiltle">Title :</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}">
            @error('title')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror

            <label for="body">Body :</label>
            <textarea id="body" name="body">{{ $post->body }}</textarea>
            @error('body')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror

            <label for="image">Image :</label>
            <input type="file" id="image" name="image">
            @error('image')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror

            <button type="submit" name="_method" value="PUT" class="btn">Update Post</button>
        </form>
    </div>
@endsection
