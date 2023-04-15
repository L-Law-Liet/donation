<?php

namespace App\Http\Requests\Campaign;

use App\Http\Requests\Api\IndexRequest;
use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Validation\Rule;

class Index extends IndexRequest
{
    /**
     * @return array
     */
    public function custom(): array
    {
        return [];
    }
}
