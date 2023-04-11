<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\Index;
use App\Http\Requests\Location\Store;
use App\Http\Requests\Location\Update;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Services\LocationService;

class LocationController extends ApiController
{
    protected function service(): string
    {
        return LocationService::class;
    }
    protected function model(): string
    {
        return Location::class;
    }
    protected function resource(): string
    {
        return LocationResource::class;
    }
    protected function storeRequest(): string
    {
        return Store::class;
    }
    protected function indexRequest(): string
    {
        return Index::class;
    }
    protected function updateRequest(): string
    {
        return Update::class;
    }
}
