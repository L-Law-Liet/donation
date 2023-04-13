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
            'family' => [['child_id', 'pair_id'], 'asc'],
            'phone' => [['phone_value'], 'asc'],
            'address' => [['address_street'], 'asc'],
            'email' => [['email_value'], 'asc'],
            '-acc' => [['acc'], 'desc'],
            '-fullname' => [['eng_name1', 'eng_name2'], 'desc'],
            '-family' => [['child_id', 'pair_id'], 'desc'],
            '-phone' => [['phone_value'], 'desc'],
            '-address' => [['address_street'], 'desc'],
            '-email' => [['email_value'], 'desc'],
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

    /**
     * @return Builder
     */
    protected function filters(): Builder
    {
        $q = parent::filters();
        return $q;
    }
}
