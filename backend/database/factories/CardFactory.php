<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num' => fake()->creditCardNumber,
            'mmyy' => fake()->creditCardExpirationDateString,
            'cvv' => rand(100, 999),
            'zip' => rand(10000, 99999),
        ];
    }
}
