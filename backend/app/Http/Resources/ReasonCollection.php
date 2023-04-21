<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReasonCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($rec) {
            return [
                'id' => $rec->id,
                'num' => $rec->num,
                'name' => $rec->name,
                'email' => $rec->email,
                'home_phone' => $rec->home_phone,
                'cell' => $rec->cell,
                'goal' => $rec->goal,
                'url' => $rec->url,
                'percentage' => $rec->percentage,
                'campaign' => $rec->campaign_name,
                'reason' => $rec->reason_name,
            ];
        })->toArray();
    }
}
