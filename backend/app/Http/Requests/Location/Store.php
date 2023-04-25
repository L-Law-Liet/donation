<?php

namespace App\Http\Requests\Location;

use App\Http\Requests\Api\StoreRequest;
use App\Models\Location;
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
            'yid_name' => [Rule::requiredIf(is_null($this->eng_name)), 'string', 'max:255'],
            'eng_name' => [Rule::requiredIf(is_null($this->yid_name)), 'string', 'max:255'],
            'type' => ['required', Rule::in(Location::TYPES)],
            'short_name' => ['string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city_state_zip' => ['required', 'string', 'max:255'],
            'rabbi' => ['string', 'max:255'],
            'phone' => ['string', 'max:255'],
        ];
    }
}
