<?php


namespace App\Helpers\DB;
use App\Models\Reply;


class ReplyRepository
{
    public static function create($reply, $demandId)
    {
        try {
            return Reply::query()->updateOrCreate(
            ['demand_id' => $demandId],
            ['text' => $reply, ]);
        }
        catch (\Throwable $th) {
            return null;
        }
    }
}