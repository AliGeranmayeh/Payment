<?php 

namespace App\Enums;


enum PaymentStatus :string {
    case SHABA_ERROR = 'shaba_error';
    case CREDIT_ERROR = 'credit_error';
    case GENERAL_ERROR = 'general_error';
    case SUCCESS = 'success';
}