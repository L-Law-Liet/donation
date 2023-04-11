<?php

namespace App\Http\Controllers;

use App\Http\Requests\Phone\Index;
use App\Http\Requests\Phone\Store;
use App\Http\Requests\Phone\Update;
use App\Http\Resources\PhoneResource;
use App\Models\Phone;
use App\Services\PhoneService;

class PhoneController extends ApiController
{
    protected function service(): string
    {
        return PhoneService::class;
    }
    protected function model(): string
    {
        return Phone::class;
    }
    protected function resource(): string
    {
        return PhoneResource::class;
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
