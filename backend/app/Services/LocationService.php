<?php

namespace App\Services;

use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationService extends ApiService
{
    protected function model(): string
    {
        return Location::class;
    }
    protected function resource(): string
    {
        return LocationResource::class;
    }
}
