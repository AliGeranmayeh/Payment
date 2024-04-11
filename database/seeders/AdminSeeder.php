<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Human;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::whereEmail('admin@admin.com')->first();
        if (!$admin) {
            User::factory()->for(Human::find(1))->create([
                'email' => 'admin@admin.com'
            ]);

            dump('admin has beeen created');
            dump('email: admin@admin.com');
            dump('password: password');
        }
    }
}
