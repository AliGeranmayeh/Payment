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

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PaymentRequest $request)
    {
        [$response, $message] = $this->paySelectedDemands($request->demands);
        $this->updateDemandStatusToPaid($request->demands);

        return PaymentResponse::pay($response, $message);
    }

    private function paySelectedDemands(array $demands)
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
            $successResponseMessage[] = $this->transferMoney($companyBankAccount, $demand);
        }

        return [PaymentStatus::SUCCESS, $successResponseMessage];
    }
    private function transferMoney($senderBankAccount, $data)
    {
        $reciverBankAccount = BankAccountRepository::find(['shaba' => $data['shaba']]);
        $bankGeteway = BankRepository::specifyGateway($reciverBankAccount->shaba);
        $this->transfer($senderBankAccount, $reciverBankAccount, $data['cost']);

        return $this->transferMoneyResponse($data['cost'], $bankGeteway);
    }

    private function transfer($sender, $reciver, $cost)
    {
        BankAccountRepository::update($sender, ['credit' => $sender->credit - $cost]);
        BankAccountRepository::update($reciver, ['credit' => $reciver->credit + $cost]);
    }

    private function transferMoneyResponse($cost, $bankGeteway)
    {
        return "The amount of $cost$ has been settled via '$bankGeteway' gateway.";
    }

    private function updateDemandStatusToPaid(array $datas)
    {
        foreach ($datas as $data) {
            DemandRepository::update(
                DemandRepository::find(['id' => $data['id']]),
                ['status' => DemandStatusEnum::PAID]);
        }
    }
}
