<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Human;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Human>
 */
class HumanFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'national_code' => fake()->unique()->regexify('[0-9]{1,10}'),
        ];
    }
}
