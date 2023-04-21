<?php

namespace App\Http\Resources;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($rec) {
            return [
                'id' => $rec->id,
                'name' => $rec->name,
                'friendly_name' => $rec->friendly_name,
                'num' => $rec->num,
                'created_at' => $rec->created_at,
                'campaigns' => new CampaignCollection($rec->campaigns),
            ];
        })->toArray();
    }
}
