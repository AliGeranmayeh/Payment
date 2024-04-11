<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BankAccount;
use App\Models\User;
use App\Models\Bank;
use App\Models\Human;

class AdminBankAccountSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $adminCompanyBankAccount = BankAccount::whereName('admin company')->first();
    if (!$adminCompanyBankAccount) {

      $adminHuman = User::whereEmail('admin@admin.com')->first()->human;
      $randomBank = Bank::query()->inRandomOrder()->first();


      $adminHuman->bankAccounts()->attach($randomBank, [
        'name' => 'admin company',
        'credit' => 1000000000,
        'password' => '123456',
        'shaba' => $this->fakeSheba($randomBank),
        'number' => fake()->unique()->numerify("################"),
      ]);


      dump('This Company bank account has been created');
      dump('name: admin company');
      dump('credit: 1000000000');
      dump('password: 123456');
    }

  }

  private function fakeSheba($bank)
  {
    return 'IR' . $bank->identifier . fake()->unique()->numerify('######################');
  }
}
