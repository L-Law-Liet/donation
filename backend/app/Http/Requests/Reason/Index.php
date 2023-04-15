<?php

namespace App\Http\Requests\Reason;

use App\Http\Requests\Api\IndexRequest;

class Index extends IndexRequest
{
    protected function custom(): array
    {
        return [
            'filter.goal_min' => 'numeric|min:0',
            'filter.goal_max' => 'numeric',
            'filter.percentage_min' => 'numeric|min:0',
            'filter.percentage_max' => 'numeric',
            'filter.campaign_id' => 'exists:campaigns,id',
        ];
    }
}
