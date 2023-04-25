<?php

namespace App\Http\Requests\Donor;

use App\Http\Requests\Api\StoreRequest;
use App\Models\Address;
use App\Models\Field;
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
            'eng_name1' => ['required', 'string', 'max:255'],
            'yid_name1' => ['string', 'max:255'],
            'yid_name2' => ['string', 'max:255'],
            'yid_title1' => ['string', 'max:255'],
            'yid_title2' => ['string', 'max:255'],
            'eng_pre' => ['string', 'max:255'],
            'eng_name2' => ['string', 'max:255'],
            'values' => ['array'],
            'values.*.field_id' => [
                'required',
                Rule::exists('fields', 'id')
                ->where('type', Field::TYPE_TEXT)
            ],
            'values.*.value' => ['required', 'string', 'max:255'],
            'options' => ['array'],
            'options.*' => ['exists:options,id'],
            'addresses' => ['array'],
            'addresses.*.type' => ['required', 'string', 'max:255'],
            'addresses.*.state' => ['required', 'string', 'max:255'],
            'addresses.*.city' => ['required', 'string', 'max:255'],
            'addresses.*.zip' => ['required', 'string', 'max:255'],
            'addresses.*.street' => ['required', 'string', 'max:255'],
            'addresses.*.apt' => ['required', 'string', 'max:255'],
            'addresses.*.title' => ['string', 'max:255'],
            'addresses.*.primary' => ['boolean'],
            'phones' => ['array'],
            'phones.*.type' => ['required', 'string', 'max:255'],
            'phones.*.value' => ['required', 'string', 'max:255'],
            'phones.*.primary' => ['boolean'],
            'emails' => ['array'],
            'emails.*.type' => ['required', 'string', 'max:255'],
            'emails.*.value' => ['required', 'string', 'email:filter', 'max:255'],
            'emails.*.primary' => ['boolean'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
            'donor_locations' => ['array'],
            'donor_locations.*.zip' => ['required', 'string', 'max:255'],
            'donor_locations.*.city' => ['required', 'string', 'max:255'],
            'donor_locations.*.name' => ['required', 'string', 'max:255'],
            'donor_locations.*.state' => ['required', 'string', 'max:255'],
            'donor_locations.*.address' => ['required', 'string', 'max:255'],
            'donor_locations.*.country' => ['required', 'string', 'max:255'],
            'child_id' => [
                Rule::exists('donors', 'id')
                    ->where('user_id', auth()->id())
            ],
            'pair_id' => [
                Rule::exists('donors', 'id')
                    ->where('user_id', auth()->id())
            ],
        ];
    }
}
