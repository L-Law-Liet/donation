<?php

namespace App\Services;

use App\Http\Resources\ReasonCollection;
use App\Http\Resources\ReasonResource;
use App\Models\Reason;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReasonService extends ApiService
{
    public static function COLS(): array
    {
        return [
            'num' => ['num'],
            'name' => ['name'],
            'email' => ['email'],
            'home_phone' => ['home_phone'],
            'cell' => ['cell'],
            'goal' => ['goal'],
            'percentage' => ['percentage'],
            'url' => ['url'],
            'campaign' => ['campaign_name'],
            'reason' => ['reason_name'],
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
    protected function preSortAggregate(): array
    {
        return [
            [
                ['campaign', 'reason'], 'name'
            ],
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
        $filter = $this->getFilter()['percentage_min']?? null;
        if (isset($filter)) {
            $q->havingRaw('percentage >= ?', [$filter]);
        }
        $filter = $this->getFilter()['percentage_max']?? null;
        if (isset($filter)) {
            $q->havingRaw('percentage <= ?', [$filter]);
        }
        return $q;
    }
    protected function preFilter(Builder $q): Builder
    {
        return $q->join('transactions', 'reasons.id', '=', 'transactions.reason_id')
            ->select('reasons.*',
                DB::raw('sum(transactions.amount) / reasons.goal * 100 as percentage'))
            ->groupBy('reasons.id');
    }

    protected function load(): array
    {
        return ['campaign', 'reason', 'transactions'];
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
