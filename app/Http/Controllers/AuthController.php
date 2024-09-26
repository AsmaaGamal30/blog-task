<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }



    public function showProfile()
    {
        $user = $this->authRepository->getUserById(Auth::id());
        $posts = $this->authRepository->posts($user->id);
        return view('blog.profile', compact('user', 'posts'));
    }

    public function editProfile()
    {
        $user = $this->authRepository->getUserById(Auth::id());
        return view('blog.update-profile', compact('user'));
    }

    public function register(RegisterRequest $request)
    {
        $this->authRepository->register($request);
        return redirect()->route('home');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authRepository->login($request)) {
            return redirect()->route('home')->with('success', 'Login successful!');
        }
        return redirect()->route('login')->with('fail', 'Incorrect credentials');
    }

    public function logout(Request $request)
    {
        $this->authRepository->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $updateSuccess = $this->authRepository->updateProfile(Auth::id(), $request->validated());
        if ($updateSuccess) {
            $updatedUser = Auth::user();

            return redirect()->route('profile')->with([
                'user' => $updatedUser
            ]);
        } else {
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    }
}
