<?php

namespace App\Services;

use App\Http\Resources\CampaignResource;
use App\Models\Campaign;

class CampaignService extends ApiService
{
    protected function model(): string
    {
        return Campaign::class;
    }
    protected function resource(): string
    {
        return CampaignResource::class;
    }
}
