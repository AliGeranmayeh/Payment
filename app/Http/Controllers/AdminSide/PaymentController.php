<?php

namespace App\Http\Controllers\AdminSide;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Enums\PaymentStatus;
use App\Helpers\DB\BankAccountRepository;
use App\Helpers\Responses\PaymentResponse;
use App\Helpers\DB\BankRepository;
use App\Helpers\DB\DemandRepository;
use App\Enums\DemandStatusEnum;
use App\Helpers\PaymentHelper;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PaymentRequest $request)
    {
        [$response, $message] = PaymentHelper::paySelectedDemands($request->demands);
        PaymentHelper::updateDemandStatusToPaid($request->demands);

        return PaymentResponse::pay($response, $message);
    }
}
