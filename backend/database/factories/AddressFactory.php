<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Provider\en_US\Address as StateAddress;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    private int $i = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement([Address::TYPE_HOME, Address::TYPE_WORK]),
            'primary' => $this->i++ < 1,
            'state' => StateAddress::stateAbbr(),
            'city' => fake()->city,
            'zip' => fake()->postcode,
            'street' => fake()->address,
            'title' => Str::random(6),
            'apt' => fake()->buildingNumber,
        ];
    }
}
