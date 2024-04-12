<?php


namespace App\Helpers\DB;
use App\Models\Bank;


class BankRepository
{
    public static function specifyGateway(string $shaba)
    {
        return Bank::where('identifier', $shaba[2] . $shaba[3])->first()->name;
    }
}
