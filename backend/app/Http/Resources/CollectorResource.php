<?php

namespace App\Http\Resources;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectorResource extends JsonResource
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
            'active' => !$this->trashed(),
            'yid_name1' => $this->yid_name1,
            'yid_name2' => $this->yid_name2,
            'yid_title1' => $this->yid_title1,
            'yid_title2' => $this->yid_title2,
            'fullname' => $this->fullname,
            'phones' => $this->whenLoaded('phones'),
            'address' => $this->whenLoaded('address'),
            'emails' => $this->whenLoaded('emails'),
            'transactions' => $this->whenLoaded('transactions'),
        ];
    }
}
