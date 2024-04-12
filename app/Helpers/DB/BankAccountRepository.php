<?php


namespace App\Helpers\DB;
use App\Models\BankAccount;


class BankAccountRepository

{
    public static function exist(array $data)
    {
        try {
            BankAccount::query()
                ->where(function ($query) use ($data) {
                foreach ($data as $key => $value) {
                    $query->where($key, $value);
                }
            })
                ->firstOrFail();
        }
        catch (\Throwable $th) {
            return false;
        }

        return true;
    }

    public static function hasCredit(BankAccount $bankAccount, int $money)
    {
        return $bankAccount->credit >= $money ? true : false;
    }

    public static function find(array $data)
    {

        return BankAccount::query()
            ->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->where($key, $value);
            }
        })
            ->first() ?? null;

    }

    public static function update(BankAccount $bankAccount, array $data)
    {
        return $bankAccount->update($data) ?? null;
    }
}
