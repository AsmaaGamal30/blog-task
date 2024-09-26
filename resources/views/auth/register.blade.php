@extends('layouts.layout')

@section('content')
    <div class="form-container">
        <form action="{{ route('post-register') }}" method="POST">
            @csrf
            <h2>Register</h2>
            @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
                @error('username')
                    <div class="text-danger error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control">
                @error('password')
                    <div class="text-danger error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                @error('password_confirmation')
                    <div class="text-danger error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Register</button>
        </form>
        <h6>Have an account? <a href="{{ route('login') }}">Login</a></h6>
    </div>
@endsection
