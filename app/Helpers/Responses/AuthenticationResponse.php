<?php



namespace App\Helpers\Responses;
use App\Models\User;
use Illuminate\Http\Response;




class AuthenticationResponse
{
    public static function register(User|null $user)
    {
        return $user ? 
            response()->json(['message' => 'Registered successfully'], Response::HTTP_OK) :
            response()->json(['message' => 'Failed to register user'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
