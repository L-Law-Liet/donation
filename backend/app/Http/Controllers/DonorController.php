<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donor\Index;
use App\Http\Requests\Donor\Store;
use App\Http\Requests\Donor\Update;
use App\Http\Resources\DonorResource;
use App\Models\Donor;
use App\Services\DonorService;

class DonorController extends ApiController
{
    protected function service(): string
    {
        return DonorService::class;
    }
    protected function model(): string
    {
        return Donor::class;
    }
    protected function resource(): string
    {
        return DonorResource::class;
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
