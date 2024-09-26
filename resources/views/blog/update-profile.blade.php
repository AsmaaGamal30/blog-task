@extends('layouts.layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Update Profile')
@section('content')
    <h2 style="text-align: center;">Update Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST" class="update-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        @error('username')
            <div class="text-danger error-message">{{ $message }}</div>
        @enderror

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" ">
                    @error('email')
        <div class="text-danger error-message">{{ $message }}</div>
    @enderror

                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password">
                    @error('new_password')
        <div class="text-danger error-message">{{ $message }}</div>
    @enderror

            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password">
            @error('password')
        <div class="text-danger error-message">{{ $message }}</div>
    @enderror




                    <button type="submit" class="btn">Update</button>
                </form>
@endsection
