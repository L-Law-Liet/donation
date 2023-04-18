<?php

namespace App\Services;

use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;

class LocationService extends ApiService
{
    public static function SORT(): array
    {
        return [
            'eng_name' => [['eng_name'], 'asc'],
            'nusach' => [['nusach'], 'asc'],
            'address' => [['address'], 'asc'],
            'rabbi' => [['rabbi'], 'asc'],
            'type' => [['type'], 'asc'],
            'short_name' => [['short_name'], 'asc'],
            'phone' => [['phone'], 'asc'],
            '-eng_name' => [['eng_name'], 'desc'],
            '-nusach' => [['nusach'], 'desc'],
            '-address' => [['address'], 'desc'],
            '-rabbi' => [['rabbi'], 'desc'],
            '-type' => [['type'], 'desc'],
            '-short_name' => [['short_name'], 'desc'],
            '-phone' => [['phone'], 'desc'],
        ];
    }

    public static function LIKES(): array
    {
        return [
            'eng_name' => 'eng_name',
            'nusach' => 'nusach',
            'rabbi' => 'rabbi',
            'short_name' => 'short_name',
            'phone' => 'phone',
        ];
    }


    protected function afterFilter(Builder $q): Builder
    {
        $filter = $this->getFilter()['type']?? null;
        if (isset($filter)) {
            $q->where('type', $filter);
        }
        return $q;
    }

    protected function load(): array
    {
        return ['transactions'];
    }

    protected function model(): string
    {
        return Location::class;
    }
    protected function resource(): string
    {
        return LocationResource::class;
    }
    protected function collection(): string
    {
        return LocationCollection::class;
    }
}
