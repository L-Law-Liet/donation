<?php

namespace App\Services;

use App\Http\Resources\SourceResource;
use App\Models\Source;

class SourceService extends ApiService
{
    protected function model(): string
    {
        return Source::class;
    }
    protected function resource(): string
    {
        return SourceResource::class;
    }
}
