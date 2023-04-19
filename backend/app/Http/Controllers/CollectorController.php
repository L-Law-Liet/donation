<?php

namespace App\Http\Controllers;

use App\Http\Requests\Collector\Index;
use App\Http\Requests\Collector\Store;
use App\Http\Requests\Collector\Update;
use App\Http\Resources\CollectorResource;
use App\Http\Resources\DonorResource;
use App\Models\Donor;
use App\Services\CollectorService;

class CollectorController extends ApiController
{
    protected function service(): string
    {
        return CollectorService::class;
    }
    protected function model(): string
    {
        return Donor::class;
    }
    protected function resource(): string
    {
        return CollectorResource::class;
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
