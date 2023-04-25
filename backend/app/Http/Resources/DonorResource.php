<?php

namespace App\Http\Resources;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $id = $this->id;
        return [
            'id' => $id,
            'acc' => $this->acc,
            'active' => !$this->trashed(),
            'yid_name1' => $this->yid_name1,
            'yid_name2' => $this->yid_name2,
            'yid_title1' => $this->yid_title1,
            'yid_title2' => $this->yid_title2,
            'fullname' => $this->fullname,
            'family' => $this->whenLoaded('child')?->fullname ?? null,
            'family_law' => $this->whenLoaded('pair')?->fullname ?? null,
            'phones' => $this->whenLoaded('phones'),
            'addresses' => $this->whenLoaded('addresses'),
            'emails' => $this->whenLoaded('emails'),
            'fields' => Field::with([
                'options' => function($q) {
                    $q->whereIn('id', $this->options()->pluck('options.id'));
                },
                'values' => function($q) {
                    $q->whereIn('id', $this->values()->pluck('id'));
                },
            ])->get(),
            'tags' => $this->whenLoaded('tags'),
            'cards' => $this->whenLoaded('cards'),
            'transactions' => $this->whenLoaded('transactions'),
            'donor_locations' => $this->whenLoaded('donor_locations'),
        ];
    }
}
