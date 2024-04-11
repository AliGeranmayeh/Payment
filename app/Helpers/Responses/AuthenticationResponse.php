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


    public static function login(bool $loggedInFlag)
    {
        return $loggedInFlag ? 
            response()->json([
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken],
            Response::HTTP_OK) :
            response()->json(['message' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);
    }


    public static function logout(bool $loggedOutnFlag)
    {
        return $loggedOutnFlag ? 
            response()->json(['message' => 'You have been successfully logged out'], Response::HTTP_OK) :
            response()->json(['message' => 'Failed to logout user'], Response::HTTP_BAD_REQUEST);
    }
}
