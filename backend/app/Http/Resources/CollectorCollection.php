<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CollectorCollection extends ResourceCollection
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
                'yid_fullname' => $rec->yid_fullname,
                'fullname' => $rec->fullname,
                'group' => $rec->group,
                'class' => $rec->class,
                'status' => is_null($rec->deleted_at) ? 'Active' : 'Inactive',
                'phone' => $rec->whenLoaded('phone'),
                'address' => $rec->whenLoaded('address'),
                'email' => $rec->whenLoaded('email'),
            ];
        })->toArray();
    }
}
