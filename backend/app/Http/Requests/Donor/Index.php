<?php

namespace App\Http\Requests\Donor;

use App\Http\Requests\Api\IndexRequest;
use App\Rules\OptionExists;
use App\Services\ApiService;
use App\Services\DonorService;
use Illuminate\Validation\Rule;

class Index extends IndexRequest
{
    protected function custom(): array
    {
        return [
            'filter.tags' => ['array'],
            'filter.tags.*' => ['exists:tags,id'],
            'filter.fields' => ['array'],
//                'filter.fields.*.id' => ['exists:fields,id'],
            'filter.fields.*.value' => ['string', 'max:255'],
            'filter.fields.*.options' => ['array'],
            'filter.fields.*.options.*' => ['exists:options,id'],
            'filter.cities.*' => ['exists:addresses,city'],
            'filter.zips.*' => ['exists:addresses,zip'],
        ];
    }
}
