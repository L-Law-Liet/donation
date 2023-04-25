<?php

namespace App\Http\Requests\Reason;

use App\Http\Requests\Api\StoreRequest;
use Illuminate\Validation\Rule;

class Store extends StoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'num' => ['required', 'integer', 'min:0'],
            'name' => ['required', 'string', 'max:255'],
            'yid_name' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'home_phone' => ['string', 'max:255'],
            'cell' => ['string', 'max:255'],
            'goal' => ['numeric', 'min:0'],
            'campaign_id' => [
                Rule::exists('campaigns', 'id')
                    ->where('user_id', auth()->id())
            ],
            'reason_id' => [
                Rule::exists('reasons', 'id')
                    ->where('user_id', auth()->id())
            ],
        ];
    }
}
