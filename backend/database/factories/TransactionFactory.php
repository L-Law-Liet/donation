<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Card;
use App\Models\Donor;
use App\Models\Location;
use App\Models\Reason;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ref = null;
        $int = null;
        $ext = null;
        $check_num = null;
        $card_id = null;
        $donor = Donor::donor()->has('cards')->inRandomOrder()->first();
        $type = fake()->randomElement(Transaction::TYPES);
        if (in_array($type, Arr::only(Transaction::TYPES, [Transaction::TYPES['other']]))) {
            $ref = Str::random(8);
        }
        if (in_array($type, Arr::only(Transaction::TYPES, [Transaction::TYPES['pledge']]))) {
            $int = fake()->words(3, true);
            $ext = fake()->words(3, true);
        }
        if (in_array($type, Arr::only(Transaction::TYPES, [Transaction::TYPES['check']]))) {
            $check_num = Str::random(8);
        }
        if (in_array($type, Arr::only(Transaction::TYPES, [Transaction::TYPES['card'], Transaction::TYPES['charity_card']]))) {
            $card_id = $donor->cards()->inRandomOrder()->first()->id;
        }
        return [
            'date' => now()->addDays(rand(-50, 0)),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'type' => $type,
            'note' => fake()->sentence,
            'check_num' => $check_num,
            'int_note' => $int,
            'ext_note' => $ext,
            'ref' => $ref,
            'reason_id' => Reason::inRandomOrder()->first()->id,
            'campaign_id' => Campaign::inRandomOrder()->first()->id,
            'location_id' => Location::inRandomOrder()->first()->id,
            'donor_id' => $donor->id,
            'collector_id' => Donor::collector()->inRandomOrder()->first()->id,
            'card_id' => $card_id,
        ];
    }
}
