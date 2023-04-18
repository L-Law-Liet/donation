<?php

namespace App\Services;

use App\Http\Resources\CampaignCollection;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Builder;

class CampaignService extends ApiService
{
    protected static function COLS(): array
    {
        return [
            'num' => ['num'],
            'name' => ['name'],
            'friendly_name' => ['friendly_name'],
        ];
    }

    public static function LIKES(): array
    {
        return [
            'name' => 'name',
            'friendly_name' => 'friendly_name',
        ];
    }

    protected function model(): string
    {
        return Campaign::class;
    }
    protected function resource(): string
    {
        return CampaignResource::class;
    }
    protected function collection(): string
    {
        return CampaignCollection::class;
    }

    protected function with(): array
    {
        return ['campaigns'];
    }

    protected function load(): array
    {
        return ['campaign', 'transactions'];
    }

    /**
     * @return Builder
     */
    protected function filters(): Builder
    {
        $q = parent::filters();
        $q->whereNull('campaign_id');
        $filter = $this->params['filter'];
        if ($where = $filter['name'] ?? null) {
            $q->where('name', 'like', "%$where%");
        }
        if ($where = $filter['friendly_name'] ?? null) {
            $q->where('friendly_name', 'like', "%$where%");
        }
        return $q;
    }
}
