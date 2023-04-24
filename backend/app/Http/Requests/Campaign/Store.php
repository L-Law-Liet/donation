<?php

namespace App\Http\Requests\Campaign;

use App\Http\Requests\Api\StoreRequest;
use Illuminate\Validation\Rule;

class Store extends StoreRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'friendly_name' => ['string', 'max:255'],
            'above' => ['numeric'],
            'campaign_id' => [
                Rule::exists('campaigns', 'id')
                    ->where('user_id', auth()->id())
            ],
        ];
    }
}
