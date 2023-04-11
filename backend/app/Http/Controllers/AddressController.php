<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\Index;
use App\Http\Requests\Address\Store;
use App\Http\Requests\Address\Update;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Services\AddressService;

class AddressController extends ApiController
{
    protected function service(): string
    {
        return AddressService::class;
    }
    protected function model(): string
    {
        return Address::class;
    }
    protected function resource(): string
    {
        return AddressResource::class;
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
