<?php

namespace App\Services;

use App\Http\Resources\ReasonResource;
use App\Models\Reason;

class ReasonService extends ApiService
{
    protected function model(): string
    {
        return Reason::class;
    }
    protected function resource(): string
    {
        return ReasonResource::class;
    }
}
