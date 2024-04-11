<?php 

namespace App\Helpers\Responses\Interfaces;


interface AuthenticationResponseInterface{

    public static function register(User|null $user);
    public static function login(bool $loggedInFlag);
    public static function logout(bool $loggedOutnFlag);
}