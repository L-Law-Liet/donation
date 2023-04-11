<?php

namespace App\Services;

use App\Http\Resources\PhoneResource;
use App\Models\Phone;

class PhoneService extends ApiService
{
    protected function model(): string
    {
        return Phone::class;
    }
    protected function resource(): string
    {
        return PhoneResource::class;
    }
}
