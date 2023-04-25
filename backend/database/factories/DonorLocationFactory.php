<?php

namespace Database\Factories;

use App\Models\Donor;
use Faker\Provider\en_US\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DonorLocation>
 */
class DonorLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(6),
            'address' => fake()->streetAddress,
            'city' => fake()->city,
            'state' => Address::stateAbbr(),
            'country' => fake()->country,
            'zip' => fake()->postcode,
            'donor_id' => Donor::donor()->inRandomOrder()->first()->id,
        ];
    }
}
