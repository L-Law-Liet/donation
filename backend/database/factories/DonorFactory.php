<?php

namespace Database\Factories;

use App\Models\Donor;
use App\Models\User;
use Faker\Provider\en_US\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donor>
 */
class DonorFactory extends Factory
{
    private int $i = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        return [
            'acc' => 1000 + $this->i++,
            'yid_name1' => fake('he_IL')->firstName,
            'yid_name2' => fake('he_IL')->lastName,
            'yid_title1' => Str::random(4),
            'yid_title2' => Str::random(4),
            'eng_pre' => fake()->title($gender),
            'eng_name1' => fake()->firstName($gender),
            'eng_name2' => fake()->firstName($gender),
            'is_donor' => fake()->boolean(66),
            'locations' => [
                [
                    'name' => Str::random(6),
                    'address' => fake()->streetAddress,
                    'city' => fake()->city,
                    'state' => Address::stateAbbr(),
                    'country' => fake()->country,
                    'zip' => fake()->postcode,
                ]
            ],
            'child_id' => Donor::donor()->find(rand(1, 100))?->id,
            'pair_id' => Donor::donor()->find(rand(1, 100))?->id,
            'user_id' => User::first()->id,
        ];
    }
}
