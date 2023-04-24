<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SourceCollection extends ResourceCollection
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
                'event' => $rec->event,
                'product' => $rec->product,
                'device_name' => $rec->device_name,
                'activation_code' => $rec->activation_code,
                'mac_address' => $rec->mac_address,
                'plan' => $rec->plan,
                'status' => $rec->status,
                'notes' => $rec->notes,
                'device_num' => $rec->device_num,
                'sim_num' => $rec->sim_num,
                'activated' => $rec->activated,
                'deactivated' => $rec->deactivated,
                'organization' => $rec->organization,
                'version' => $rec->version,
                'campaign_name' => $rec->campaign_name,
                'reason_name' => $rec->reason_name,
                'location_eng_name' => $rec->location_eng_name,
                'collector_fullname' => $rec->collector_fullname,
            ];
        })->toArray();
    }
}
