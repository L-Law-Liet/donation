<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reason\Index;
use App\Http\Requests\Reason\Store;
use App\Http\Requests\Reason\Update;
use App\Http\Resources\ReasonResource;
use App\Models\Reason;
use App\Services\ReasonService;

class ReasonController extends ApiController
{
    protected function service(): string
    {
        return ReasonService::class;
    }
    protected function model(): string
    {
        return Reason::class;
    }
    protected function resource(): string
    {
        return ReasonResource::class;
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
