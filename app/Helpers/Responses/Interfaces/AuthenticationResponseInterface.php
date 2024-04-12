<?php 

namespace App\Helpers\Responses\Interfaces;

use App\Models\User;


interface AuthenticationResponseInterface{

    public static function register(User|null $user);
    public static function login(bool $loggedInFlag);
    public static function logout(bool $loggedOutnFlag);
}