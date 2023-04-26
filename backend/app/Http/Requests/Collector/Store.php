<?php

namespace App\Http\Requests\Collector;

use App\Http\Requests\Api\StoreRequest;
use App\Models\Address;
use App\Models\Phone;
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
        $this->is_donor = false;
        return [
            'acc' => ['string', 'max:255'],
            'yid_name1' => ['string', 'max:255'],
            'yid_name2' => ['string', 'max:255'],
            'yid_title1' => ['string', 'max:255'],
            'yid_title2' => ['string', 'max:255'],
            'eng_pre' => ['string', 'max:255'],
            'eng_name1' => ['required', 'string', 'max:255'],
            'eng_name2' => ['string', 'max:255'],

            'addresses' => ['array'],
            'addresses.*.type' => ['required', Rule::in([Address::TYPE_HOME])],
            'addresses.*.title' => ['string', 'max:255'],
            'addresses.*.street' => ['required', 'string', 'max:255'],
            'addresses.*.state' => ['required', 'string', 'max:255'],
            'addresses.*.city' => ['required', 'string', 'max:255'],
            'addresses.*.zip' => ['required', 'string', 'max:255'],
            'addresses.*.apt' => ['required', 'string', 'max:255'],
            'addresses.*.primary' => ['boolean'],
            'phones' => ['array'],
            'phones.*.type' => ['required', Rule::in(Phone::TYPE_HOME, Phone::TYPE_CELL)],
            'phones.*.value' => ['required', 'string', 'max:255'],
            'phones.*.primary' => ['boolean'],
            'emails' => ['array'],
            'emails.*.value' => ['required', 'string', 'email', 'max:255'],
            'emails.*.primary' => ['boolean'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        $data['is_donor'] = false;
        return $data;
    }

}
