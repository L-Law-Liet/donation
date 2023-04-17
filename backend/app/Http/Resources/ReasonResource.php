<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $percentage = ($this->goal == 0)
            ? null
            : $this->transactions()->sum('amount') / $this->goal * 100;
        return [
            'id' => $this->id,
            'num' => $this->num,
            'name' => $this->name,
            'email' => $this->email,
            'home_phone' => $this->home_phone,
            'cell' => $this->cell,
            'goal' => $this->goal,
            'percentage' => $percentage,
            'campaign' => $this->whenLoaded('campaign'),
            'reason' => $this->whenLoaded('reason'),
            'transactions' => $this->whenLoaded('transactions'),
        ];
    }
}
