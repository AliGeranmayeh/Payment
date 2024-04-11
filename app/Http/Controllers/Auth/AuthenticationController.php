<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Helpers\DB\UserRepository;
use App\Helpers\Responses\AuthenticationResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = UserRepository::create($request->validated());

        return AuthenticationResponse::register($user);
    }

    public function login(LoginRequest $request)
    {
        $isLoggedIn = $this->checkLoginCredentials($request->validated());

        return AuthenticationResponse::login($isLoggedIn);
    }

    public function logout()
    {
        $isLoggedOut = $this->performeLogout();

        return AuthenticationResponse::logout($isLoggedOut);
    }


    private function checkLoginCredentials(array $loginData)
    {
        return Auth::attempt($loginData) ? true : false;
    }


    private function performeLogout()
    {
        try {
            auth()->user()->tokens()->delete();
        }
        catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
