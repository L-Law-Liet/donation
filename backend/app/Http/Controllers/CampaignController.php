<?php

namespace App\Http\Controllers;

use App\Http\Requests\Campaign\Index;
use App\Http\Requests\Campaign\Store;
use App\Http\Requests\Campaign\Update;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Services\CampaignService;

class CampaignController extends ApiController
{
    protected function service(): string
    {
        return CampaignService::class;
    }
    protected function model(): string
    {
        return Campaign::class;
    }
    protected function resource(): string
    {
        return CampaignResource::class;
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
