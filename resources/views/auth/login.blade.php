@extends('layouts.layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')
@section('content')

    <div class="form-container">
        <h2>Login</h2>
        <form action="{{ route('post-login') }}" method="POST">
            @csrf
            @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="**********">
            @error('password')
                <div class="text-danger error-message">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn">Login</button>
        </form>
        <h6>Don't have an account? <a href="{{ route('register') }}">Register</a></h6>
    </div>

@endsection
