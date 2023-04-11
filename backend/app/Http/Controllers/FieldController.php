<?php

namespace App\Http\Controllers;

use App\Http\Requests\Field\Index;
use App\Http\Requests\Field\Store;
use App\Http\Requests\Field\Update;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use App\Services\FieldService;

class FieldController extends ApiController
{
    protected function service(): string
    {
        return FieldService::class;
    }
    protected function model(): string
    {
        return Field::class;
    }
    protected function resource(): string
    {
        return FieldResource::class;
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
