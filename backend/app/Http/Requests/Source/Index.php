<?php

namespace App\Http\Requests\Source;

use App\Http\Requests\Api\IndexRequest;
use App\Models\Source;
use Illuminate\Validation\Rule;

class Index extends IndexRequest
{
    protected function custom(): array
    {
        return [
            'filter.device_types' => ['array'],
            'filter.device_types.*' => [Rule::in(Source::DEVICE_TYPES)],
            'filter.statuses' => ['array'],
            'filter.statuses.*' => [Rule::in(Source::STATUSES)],
        ];
    }
}
