<?php

namespace App\Http\Controllers;

use App\Http\Requests\Card\Index;
use App\Http\Requests\Card\Store;
use App\Http\Requests\Card\Update;
use App\Http\Resources\CardResource;
use App\Models\Card;
use App\Services\CardService;

class CardController extends ApiController
{
    protected function service(): string
    {
        return CardService::class;
    }
    protected function model(): string
    {
        return Card::class;
    }
    protected function resource(): string
    {
        return CardResource::class;
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
