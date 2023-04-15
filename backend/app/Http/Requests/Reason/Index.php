<?php

namespace App\Http\Requests\Reason;

use App\Http\Requests\Api\IndexRequest;

class Index extends IndexRequest
{
    protected function custom(): array
    {
        return [];
    }
}
