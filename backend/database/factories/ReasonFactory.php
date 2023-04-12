<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Reason;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reason>
 */
class ReasonFactory extends Factory
{
    private int $i = 1000;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::random(rand(4, 10));
        return [
            'num' => $this->i++,
            'name' => $name,
            'yid_name' => $name,
            'email' => fake()->email,
            'home_phone' => fake()->phoneNumber,
            'cell' => fake()->e164PhoneNumber,
            'goal' => fake()->randomFloat(2, 100, 10000),
            'campaign_id' => Campaign::inRandomOrder()->first()->id,
            'reason_id' => Reason::find(rand(1, 100))?->id,
            'user_id' => User::first()->id,
        ];
    }
}
