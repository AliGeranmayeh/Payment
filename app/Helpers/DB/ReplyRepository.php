<?php


namespace App\Helpers\DB;
use App\Models\Reply;


class ReplyRepository
{
    public static function create($reply, $demandId)
    {
        try {
            return Reply::create([
                'text' => $reply,
                'demand_id' => $demandId
            ]);
        }
        catch (\Throwable $th) {
            return null;
        }
    }
}