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
                'eng_pre' => $rec->eng_pre,
                'eng_name1' => $rec->eng_name1,
                'eng_name2' => $rec->eng_name2,
                'yid_name1' => $rec->yid_name1,
                'yid_name2' => $rec->yid_name2,
                'yid_title1' => $rec->yid_title1,
                'yid_title2' => $rec->yid_title2,
                'family' => $rec->whenLoaded('child')?->fullname ?? null,
                'family_law' => $rec->whenLoaded('pair')?->fullname ?? null,
                'phones' => $rec->whenLoaded('phones'),
                'address' => $rec->whenLoaded('address'),
                'emails' => $rec->whenLoaded('emails'),
                'tags' => $rec->whenLoaded('tags'),
                'options' => $rec->whenLoaded('options')->groupBy('field_id'),
                'values' => $rec->whenLoaded('values')->groupBy('field_id'),
            ];
        })->toArray();
    }
}
