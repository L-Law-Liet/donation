<?php

namespace App\Services;

use App\Http\Resources\DonorResource;
use App\Models\Donor;

class DonorService extends ApiService
{
    protected function model(): string
    {
        return Donor::class;
    }
    protected function resource(): string
    {
        return DonorResource::class;
    }
}
