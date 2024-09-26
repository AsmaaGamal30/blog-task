<?php

namespace App\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    public function register($request)
    {
        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        Auth::login($user);

        return $user;
    }

    public function login($request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return true;
        }
        return false;
    }

    public function logout()
    {
        return  Auth::logout();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateProfile($id, $request)
    {
        $user = User::findOrFail($id);
        if (isset($request['username'])) {
            $user->username = $request['username'];
        }

        if (isset($request['email'])) {
            $user->email = $request['email'];
        }

        if (isset($request['new_password']) && !empty($request['new_password'])) {
            $user->password = Hash::make($request['new_password']);
        }

        $saved = $user->save();
        return $saved;
    }

    public function posts($id)
    {
        $posts = Post::orderByDesc("created_at")->with('user')->where('user_id', $id)->paginate(10);
        return  $posts;
    }
}
