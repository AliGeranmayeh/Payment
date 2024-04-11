<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Helpers\DB\UserRepository;
use App\Helpers\Responses\AuthenticationResponse;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = UserRepository::create($request->validated());

        return AuthenticationResponse::register($user);
    }

    public function login(Request $request)
    {
        # code...
    }

    public function logout()
    {
        # code...
    }
}
