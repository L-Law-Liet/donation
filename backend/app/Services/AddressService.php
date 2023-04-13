<?php

namespace App\Services;

use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressResource;
use App\Models\Address;

class AddressService extends ApiService
{
    protected function model(): string
    {
        return Address::class;
    }
    protected function resource(): string
    {
        return AddressResource::class;
    }
    protected function collection(): string
    {
        return AddressCollection::class;
    }
}
