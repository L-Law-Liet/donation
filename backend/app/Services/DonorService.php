<?php

namespace App\Services;

use App\Http\Resources\DonorCollection;
use App\Http\Resources\DonorResource;
use App\Models\Donor;
use Illuminate\Database\Eloquent\Builder;

class DonorService extends ApiService
{
    public static function SORT(): array
    {
        return [
            'acc' => [['acc'], 'asc'],
            'fullname' => [['eng_name1', 'eng_name2'], 'asc'],
            'family' => [['family'], 'asc'],
            'phone' => [['phone_value'], 'asc'],
            'address' => [['address_street'], 'asc'],
            'email' => [['email_value'], 'asc'],
            '-acc' => [['acc'], 'desc'],
            '-fullname' => [['eng_name1', 'eng_name2'], 'desc'],
            '-family' => [['family'], 'desc'],
            '-phone' => [['phone_value'], 'desc'],
            '-address' => [['address_street'], 'desc'],
            '-email' => [['email_value'], 'desc'],
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
        return $q;
    }
}
