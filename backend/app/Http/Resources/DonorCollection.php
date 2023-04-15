<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DonorCollection extends ResourceCollection
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
                'acc' => $rec->acc,
                'yid_fullname' => $rec->yid_fullname,
                'fullname' => $rec->fullname,
                'family' => $rec->whenLoaded('child')?->fullname ?? null,
                'family_law' => $rec->whenLoaded('pair')?->fullname ?? null,
                'phones' => $rec->whenLoaded('phones'),
                'address' => $rec->whenLoaded('address'),
                'emails' => $rec->whenLoaded('emails'),
            ];
        })->toArray();
    }
}
