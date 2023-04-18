<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LocationCollection extends ResourceCollection
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
                'yid_name' => $rec->yid_name,
                'eng_name' => $rec->eng_name,
                'nusach' => $rec->nusach,
                'type' => $rec->type,
                'short_name' => $rec->short_name,
                'address' => $rec->address,
                'rabbi' => $rec->rabbi,
                'phone' => $rec->phone,
            ];
        })->toArray();
    }
}
