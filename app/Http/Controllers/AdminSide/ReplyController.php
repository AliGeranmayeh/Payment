<?php

namespace App\Http\Controllers\AdminSide;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReplyRequest;
use App\Models\Demand;
use App\Helpers\DB\ReplyRepository;
use App\Helpers\Responses\ReplyResponse;
use App\Enums\DemandStatusEnum;

class ReplyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateReplyRequest $request, Demand $demand)
    {
        if ($demand->status == DemandStatusEnum::DECLINED) {
            $reply = ReplyRepository::create($request->text, $demand->id);
        }

        return ReplyResponse::create($reply ?? null);
    }
}
