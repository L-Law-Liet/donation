<?php

namespace App\Services;

use App\Http\Resources\FieldResource;
use App\Models\Field;

class FieldService extends ApiService
{
    protected function model(): string
    {
        return Field::class;
    }
    protected function resource(): string
    {
        return FieldResource::class;
    }
}
