<?php

namespace Database\Factories;

use App\Models\Location;
use Faker\Provider\en_US\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::random(6);
        return [
            'yid_name' => $name,
            'eng_name' => $name,
            'type' => fake()->randomElement(Location::TYPES),
            'short_name' => Str::limit($name, 4),
            'address' => fake()->address,
            'city_state_zip' => implode(' ', [fake()->city, Address::stateAbbr(), fake()->postcode]),
            'rabbi' => Str::limit(8),
            'phone' => fake()->phoneNumber,
        ];
    }
}
