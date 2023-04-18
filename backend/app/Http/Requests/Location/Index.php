<?php

namespace App\Http\Requests\Location;

use App\Http\Requests\Api\IndexRequest;
use App\Models\Location;
use Illuminate\Validation\Rule;

class Index extends IndexRequest
{

    protected function custom(): array
    {
        return [
            'filter.type' => Rule::in(Location::TYPES),
        ];
    }
}
