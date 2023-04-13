<?php

namespace App\Http\Requests\Donor;

use App\Http\Requests\Api\IndexRequest;
use App\Rules\OptionExists;
use App\Services\ApiService;
use App\Services\DonorService;
use Illuminate\Validation\Rule;

class Index extends IndexRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = array_merge(
            $this->getDefault(),
            [
                'filter.tags' => ['array'],
                'filter.tags.*' => ['exists:tags,title'],
                'filter.fields' => ['array'],
                'filter.fields.*.value' => ['exists:fields'],
                'filter.fields.*.options' => ['array'],
                'filter.fields.*.options.*' => [new OptionExists],
                'filter.cities.*' => ['exists:addresses,city'],
                'filter.zips.*' => ['exists:addresses,zip'],
            ]
        );
        return $rules;
    }
}
