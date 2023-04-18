<?php

namespace App\Services;

use App\Http\Resources\DonorCollection;
use App\Http\Resources\DonorResource;
use App\Models\Donor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class DonorService extends ApiService
{
    protected static function COLS(): array
    {
        return [
            'acc' => ['acc'],
            'fullname' => ['eng_name1', 'eng_name2'],
            'family' => ['child_id', 'pair_id'],
            'phone' => ['phone_value'],
            'address' => ['address_street'],
            'email' => ['email_value'],
        ];
    }

    public static function LIKES(): array
    {
        return [
            'acc' => 'acc',
            'fullname' => 'fullname',
            'yid_fullname' => 'yid_fullname',
            'phone' => 'phone.value',
            'email' => 'email.value',
            'father' => 'child.fullname',
            'father_law' => 'pair.fullname',
        ];
    }

    protected function model(): string
    {
        return Donor::class;
    }
    protected function resource(): string
    {
        return DonorResource::class;
    }
    protected function collection(): string
    {
        return DonorCollection::class;
    }

    protected function preSortAggregate(): array
    {
        return [
            [
                ['address'], 'street'
            ],
            [
                ['phone', 'email'], 'value'
            ],
        ];
    }

    protected function with(): array
    {
        return [
            'child:id,fullname',
            'pair:id,fullname',
            'phones:donor_id,value,type',
            'address',
            'emails:donor_id,value,type',
        ];
    }

    protected function load(): array
    {
        return [
            'child',
            'pair',
            'phones',
            'addresses',
            'emails',
            'tags',
            'cards',
            'transactions',
        ];
    }

    /**
     * @param Builder $q
     * @return Builder
     */
    protected function afterFilter(Builder $q): Builder
    {
        $tags = $this->getFilter()['tags'] ?? null;
        if ($tags) {
            $q->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('id', $tags);
            });
        }
        $fields = $this->getFilter()['fields'] ?? null;
        if ($fields && count($field_values = Arr::pluck($fields, 'value')) > 0) {
            $q->whereHas('values', function ($query) use ($field_values) {
                $query->where(function ($qu) use ($field_values) {
                    foreach ($field_values as $field_value) {
                        $qu->orWhere('value', 'like', "%$field_value%");
                    }
                });
            });
        }
        if ($fields && count($options = Arr::pluck($fields, 'options')) > 0) {
            $q->whereHas('options', function ($query) use ($options) {
                $query->whereIn('options.id', Arr::collapse($options));
            });
        }

        $cities = $this->getFilter()['cities'] ?? [];
        $zips = $this->getFilter()['zips'] ?? [];
        if ($cities || $zips) {
            $q->whereHas('addresses', function ($query) use ($cities, $zips) {
                $query->whereIn('city', $cities)
                ->orWhereIn('zip', $zips);
            });
        }
        return $q;
    }

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        $q = parent::query();
        return $q->donor();
    }
}
