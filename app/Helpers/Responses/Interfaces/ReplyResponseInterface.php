<?php 

namespace App\Helpers\Responses\Interfaces;

use App\Models\Reply;



interface ReplyResponseInterface{
    public static function create(Reply|null $reply);
}