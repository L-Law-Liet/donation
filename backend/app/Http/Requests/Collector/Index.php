<?php

namespace App\Http\Requests\Collector;

use App\Http\Requests\Api\IndexRequest;
use App\Rules\OptionExists;
use App\Services\ApiService;
use App\Services\DonorService;
use Illuminate\Validation\Rule;

class Index extends IndexRequest
{
    protected function custom(): array
    {
        return [];
    }
}
