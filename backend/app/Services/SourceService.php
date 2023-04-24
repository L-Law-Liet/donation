<?php

namespace App\Services;

use App\Http\Resources\SourceCollection;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Database\Eloquent\Builder;

class SourceService extends ApiService
{
    protected static function COLS(): array
    {
        return [
            'event' => ['event'],
            'product' => ['product'],
            'device_name' => ['device_name'],
            'activation_code' => ['activation_code'],
            'mac_address' => ['mac_address'],
            'plan' => ['plan'],
            'status' => ['status'],
            'notes' => ['notes'],
            'device_num' => ['device_num'],
            'sim_num' => ['sim_num'],
            'activated' => ['activated'],
            'deactivated' => ['deactivated'],
            'organization' => ['organization'],
            'version' => ['version'],
            'collector' => ['collector_fullname'],
            'campaign' => ['campaign_name'],
            'reason' => ['reason_name'],
            'location' => ['location_name'],
        ];
    }

    public static function LIKES(): array
    {
        return [
            'event' => 'event',
            'product' => 'product',
            'device_name' => 'device_name',
            'activation_code' => 'activation_code',
            'mac_address' => 'mac_address',
            'plan' => 'plan',
            'notes' => 'notes',
            'device_num' => 'device_num',
            'sim_num' => 'sim_num',
            'collector' => 'collector.fullname',
            'campaign' => 'campaign.name',
            'reason' => 'reason.name',
            'location' => 'location.name',
        ];
    }

    protected function preSortAggregate(): array
    {
        return [
            [
                ['campaign', 'reason'], 'name'
            ],
            [
                ['location'], 'eng_name'
            ],
            [
                ['collector'], 'fullname'
            ],
        ];
    }


    protected function afterFilter(Builder $q): Builder
    {
        $filter = $this->getFilter()['statuses']?? null;
        if (isset($filter)) {
            $q->whereIn('status', $filter);
        }
        $filter = $this->getFilter()['device_types']?? null;
        if (isset($filter)) {
            $q->whereIn('device_type', $filter);
        }
        return $q;
    }

    protected function load(): array
    {
        return ['reason:id,name', 'campaign:id,name', 'location', 'collector:id,fullname',];
    }

    protected function model(): string
    {
        return Source::class;
    }
    protected function resource(): string
    {
        return SourceResource::class;
    }

    protected function collection(): string
    {
        return SourceCollection::class;
    }
}
