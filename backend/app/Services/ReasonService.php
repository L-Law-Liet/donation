<?php

namespace App\Services;

use App\Http\Resources\ReasonCollection;
use App\Http\Resources\ReasonResource;
use App\Models\Reason;
use Illuminate\Database\Eloquent\Builder;

class ReasonService extends ApiService
{
    public static function SORT(): array
    {
        return [
            'num' => [['num'], 'asc'],
            'name' => [['name'], 'asc'],
            'email' => [['email'], 'asc'],
            'home_phone' => [['home_phone'], 'asc'],
            'cell' => [['cell'], 'asc'],
            'goal' => [['goal'], 'asc'],
            'percentage' => [['percentage'], 'asc'],
            '-num' => [['num'], 'desc'],
            '-name' => [['name'], 'desc'],
            '-email' => [['email'], 'desc'],
            '-home_phone' => [['home_phone'], 'desc'],
            '-cell' => [['cell'], 'desc'],
            '-goal' => [['goal'], 'desc'],
            '-percentage' => [['percentage'], 'desc'],
        ];
    }

    public static function LIKES(): array
    {
        return [
            'num' => 'num',
            'name' => 'name',
            'email' => 'email',
            'home_phone' => 'home_phone',
            'cell' => 'cell',
        ];
    }

    protected function afterFilter(Builder $q): Builder
    {
        $filter = $this->getFilter()['goal_min']?? null;
        if (isset($filter)) {
            $q->where('goal', '>=', $filter);
        }
        $filter = $this->getFilter()['goal_max']?? null;
        if (isset($filter)) {
            $q->where('goal', '<=', $filter);
        }
        $filter = $this->getFilter()['campaign_id']?? null;
        if (isset($filter)) {
            $q->where('campaign_id', $filter);
        }

        $q->withSum('transactions as percentage', 'amount');
        $filter = $this->getFilter()['percentage_min']?? null;
        if (isset($filter)) {
            $q->having('percentage', '>=', $filter);
        }
        $filter = $this->getFilter()['percentage_max']?? null;
        if (isset($filter)) {
            $q->having('percentage', '<=', $filter);
        }
        return $q;
    }

    protected function model(): string
    {
        return Reason::class;
    }
    protected function resource(): string
    {
        return ReasonResource::class;
    }

    protected function collection(): string
    {
        return ReasonCollection::class;
    }
}
