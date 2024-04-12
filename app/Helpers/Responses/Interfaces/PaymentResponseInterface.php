<?php


namespace App\Helpers\Responses\Interfaces;


interface PaymentResponseInterface
{
    public static function pay($status,$message);
}