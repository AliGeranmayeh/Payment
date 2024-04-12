<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Enums\DemandStatusEnum;
use App\Helpers\PaymentHelper;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Log;
use App\Models\Demand;

class PaymentSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pay sccepted demands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $acceptedDemands = Demand::where('status', DemandStatusEnum::ACCEPTED)->get();
        $acceptedDemands->map(
            fn($demand) => [
                'id' => $demand->id,
                'cost' => $demand->cost,
                'shaba' => $demand->shaba
            ]
        )->toArray();

        [$status, $message] = PaymentHelper::paySelectedDemands($acceptedDemands);
        PaymentHelper::updateDemandStatusToPaid($acceptedDemands);

        $this->addLog($status, $message);
    }


    private function addLog($status, $message)
    {
        match ($status) {
            PaymentStatus::SUCCESS =>Log::info("scheduled task message", $message),
            PaymentStatus::SHABA_ERROR => Log::alert('Invalid Shaba.'),
            PaymentStatus::CREDIT_ERROR =>Log::alert('Not enough credit.'),
            default => Log::alert('Something went wrong.')
        };
    }
}
