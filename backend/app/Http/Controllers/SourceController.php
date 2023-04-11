<?php

namespace App\Http\Controllers;

use App\Http\Requests\Source\Index;
use App\Http\Requests\Source\Store;
use App\Http\Requests\Source\Update;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use App\Services\SourceService;

class SourceController extends ApiController
{
    protected function service(): string
    {
        return SourceService::class;
    }
    protected function model(): string
    {
        return Source::class;
    }
    protected function resource(): string
    {
        return SourceResource::class;
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
