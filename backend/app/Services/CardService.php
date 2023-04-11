<?php

namespace App\Services;

use App\Http\Resources\CardResource;
use App\Models\Card;

class CardService extends ApiService
{
    protected function model(): string
    {
        return Card::class;
    }
    protected function resource(): string
    {
        return CardResource::class;
    }
}
