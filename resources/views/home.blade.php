@extends('layouts.layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <h2>Posts</h2>
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif

    <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
        @foreach ($posts as $post)
            <div class="post">
                <x-post username="{{ $post->user->username }}" title="{{ $post->title }}" postId="{{ $post->id }}"
                    image="{{ !empty($post->image) ? Storage::url($post->image) : '' }}" body="{{ $post->getExcerpt(50) }}"
                    :isLink="true" />
            </div>
        @endforeach
    </div>
    <x-pagination :paginator="$posts" />
@endsection
