<?php


namespace App\Helpers;
use App\Helpers\DB\BankAccountRepository;
use App\Enums\PaymentStatus;
use App\Helpers\DB\BankRepository;
use App\Helpers\DB\DemandRepository;
use App\Enums\DemandStatusEnum;

class PaymentHelper

{
    public static function paySelectedDemands(array $demands)
    {
        $successResponseMessage = [];
        foreach ($demands as $demand) {
            if (!BankAccountRepository::exist(['shaba' => $demand['shaba']])) {
                return [PaymentStatus::SHABA_ERROR, []];
            }

            $companyBankAccount = BankAccountRepository::find(['shaba' => config('app.company_shaba')]);
            if (!BankAccountRepository::hasCredit($companyBankAccount, $demand['cost'])) {
                return [PaymentStatus::CREDIT_ERROR, []];
            }
            $successResponseMessage[] = static::transferMoney($companyBankAccount, $demand);
        }

        return [PaymentStatus::SUCCESS, $successResponseMessage];
    }

    public static function transferMoney($senderBankAccount, $data)
    {
        $reciverBankAccount = BankAccountRepository::find(['shaba' => $data['shaba']]);
        $bankGeteway = BankRepository::specifyGateway($reciverBankAccount->shaba);
        static::transfer($senderBankAccount, $reciverBankAccount, $data['cost']);

        return static::transferMoneyResponse($data['cost'], $bankGeteway);
    }

    public static function transfer($sender, $reciver, $cost)
    {
        BankAccountRepository::update($sender, ['credit' => $sender->credit - $cost]);
        BankAccountRepository::update($reciver, ['credit' => $reciver->credit + $cost]);
    }

    public static function transferMoneyResponse($cost, $bankGeteway)
    {
        return "The amount of $cost$ has been settled via '$bankGeteway' gateway.";
    }


    public static function updateDemandStatusToPaid(array $datas)
    {
        foreach ($datas as $data) {
            DemandRepository::update(
                DemandRepository::find(['id' => $data['id']]),
                ['status' => DemandStatusEnum::PAID]);
        }
    }
}
