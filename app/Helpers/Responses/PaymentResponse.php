<?php 

namespace App\Helpers\Responses;
use App\Helpers\Responses\Interfaces\PaymentResponseInterface;
use App\Enums\PaymentStatus;
use Symfony\Component\HttpFoundation\Response;


class PaymentResponse  implements PaymentResponseInterface
{
    public static function pay($status , $message)
    {
        return match($status) {
            PaymentStatus::SUCCESS => response()->json(['message' => $message], Response::HTTP_OK),
            PaymentStatus::SHABA_ERROR => response()->json(['error' => 'Invalid Shaba.'], Response::HTTP_NOT_FOUND),
            PaymentStatus::CREDIT_ERROR => response()->json(['error' => 'Not enough credit.'], Response::HTTP_FORBIDDEN),
            default => response()->json(['error' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR),
        };
    }
}
