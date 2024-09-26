<?php

namespace App\Http\Interfaces;


interface AuthInterface
{
    public function register($request);

    public function login($request);

    public function logout();

    public function getUserById($id);

    public function updateProfile($id, $request);

    public function posts($id);
}
