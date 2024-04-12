<?php


namespace App\Helpers\Responses;
use App\Helpers\Responses\Interfaces\ReplyResponseInterface;
use App\Models\Reply;
use Symfony\Component\HttpFoundation\Response;


class ReplyResponse implements ReplyResponseInterface
{
    public static function create(Reply|null $reply)
    {
        return $reply ? 
            response()->json(['message' => 'Reply has been added'], Response::HTTP_OK) :
            response()->json(['message' => 'Failed to add reply to demand'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
