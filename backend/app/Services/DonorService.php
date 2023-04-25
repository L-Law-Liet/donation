<?php

namespace App\Services;

use App\Http\Resources\DonorCollection;
use App\Http\Resources\DonorResource;
use App\Models\Donor;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\Option;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DonorService extends ApiService
{
    protected static function COLS(): array
    {
        $cols = [
            'acc' => ['acc'],
            'fullname' => ['fullname', 'yid_fullname'],
            'yid_fullname' => ['yid_fullname'],
            'eng_fullname' => ['fullname'],
            'family' => ['child_id', 'pair_id'],
            'phone' => ['phone_value'],
            'address' => ['address_street'],
            'email' => ['email_value'],
            'city_state_zip' => ['address_city', 'address_state', 'address_zip'],
            'father' => ['child_fullname'],
            'father_law' => ['pair_fullname'],
            'tag' => ['donor_tag_tag_id'],
            'eng_pre' => ['eng_pre'],
            'eng_name1' => ['eng_name1'],
            'eng_name2' => ['eng_name2'],
            'yid_name1' => ['yid_name1'],
            'yid_name2' => ['yid_name2'],
            'yid_title1' => ['yid_title1'],
            'yid_title2' => ['yid_title2'],
        ];
        foreach (Field::all() as $field) {
            $key = 'fields.'.$field->id;
            static::$customSorts[] = $key;
            $cols[$key] = [$field->type, $field->id];
        }
        return $cols;
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
                ['address'], 'city'
            ],
            [
                ['address'], 'state'
            ],
            [
                ['address'], 'zip'
            ],
            [
                ['child', 'pair'], 'fullname'
            ],
            [
                ['donor_tag'], 'tag_id'
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
            'tags',
            'emails:donor_id,value,type',
            'options:value,field_id',
            'values:donor_id,field_id,value',
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
            'donor_locations',
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

    protected function customSort(Builder $q): Builder
    {
        $sort = $this->params['sort'];
        [[$type, $id], $dir] = self::SORT()[$sort];
//        dd($type, $id, $dir);
        if ($type == Field::TYPE_TEXT) {
            $q->leftJoinSub(
                FieldValue::select('donor_id', 'value')
                    ->where('field_id', $id)
                    ->groupBy('donor_id', 'value'),
                'fv',
                'donors.id',
                '=',
                'fv.donor_id')
                ->orderBy('fv.value', $dir)
                ->select('donors.*');
        } else {
            $q->leftJoinSub(
                Option::select('do.donor_id', 'value')
                    ->where('field_id', $id)
                    ->leftJoin('donor_option as do', 'do.option_id', '=', 'options.id')
                    ->groupBy('do.donor_id', 'value'),
                'o',
                'donors.id',
                '=',
                'o.donor_id')
                ->orderBy('o.value', $dir)
                ->select('donors.*');
        }
        return $q;
    }
}
