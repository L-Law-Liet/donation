<?php

namespace App\Services;

use App\Http\Resources\CollectorCollection;
use App\Http\Resources\CollectorResource;
use App\Http\Resources\DonorCollection;
use App\Http\Resources\DonorResource;
use App\Models\Donor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class CollectorService extends ApiService
{
    protected static function COLS(): array
    {
        return [
            'fullname' => ['eng_name1', 'eng_name2'],
            'address' => ['address_street'],
            'group' => ['group'],
            'class' => ['class'],
            'phone' => ['phone_value'],
            'email' => ['email_value'],
            'status' => ['deleted_at'],
        ];
    }

    public static function LIKES(): array
    {
        return [
            'acc' => 'acc',
            'fullname' => 'fullname',
            'yid_fullname' => 'yid_fullname',
            'address' => 'address.street',
            'city' => 'address.city',
            'state' => 'address.state',
            'zip' => 'address.zip',
            'group' => 'group',
            'class' => 'class',
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
        return CollectorResource::class;
    }
    protected function collection(): string
    {
        return CollectorCollection::class;
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
            'phone:donor_id,value,type',
            'address',
            'email:donor_id,value,type',
        ];
    }

    protected function load(): array
    {
        return [
            'phones',
            'address',
            'emails',
            'transactions',
        ];
    }

    protected function query(): Builder
    {
        $q = parent::query();
        return $q->collector();
    }

    public function show(string $id)
    {
        return new ($this->resource())(
            $this->model->collector()
                ->findOrFail($id)
                ->load($this->load())
        );
    }
}
