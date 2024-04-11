<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Helpers\DB\UserRepository;
use App\Helpers\Responses\AuthenticationResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = UserRepository::create($request->validated());

        return AuthenticationResponse::register($user);
    }

    public function login(LoginRequest $request)
    {
        # code...
    }

    public function logout()
    {
        # code...
    }
}
