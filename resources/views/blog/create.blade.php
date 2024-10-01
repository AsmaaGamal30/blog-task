@extends('layouts.layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Post')
@section('content')
    <div class="form-container">
        <h2>Create Post</h2>
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="title">Title:</label>
            <input type="text" id="title" name="title">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
            @error('title')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror
            <label for="body">Body:</label>
            <textarea type="text" id="body" name="body"></textarea>
            @error('body')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            @error('image')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn">Create Post</button>
        </form>
    </div>
@endsection
