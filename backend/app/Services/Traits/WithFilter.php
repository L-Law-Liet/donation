<?php

namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

trait WithFilter
{
    public static function STATUS(): array
    {
        return [
            'Active' => 'Active',
            'Inactive' => 'Inactive',
            'All' => 'All',
        ];
    }

    public static function LIKES(): array
    {
        return [];
    }

    protected function query(): Builder
    {
        return $this->model->query();
    }

    protected function preFilter(Builder $q): Builder
    {
        return $q;
    }

    protected function preFilterAggregate(): array
    {
        return [];
    }

    protected function filters(): Builder
    {
        $q = $this->query();
        $q = $this->preFilter($q);
        foreach ($this->preFilterAggregate() as $agg) {
            $q->withAggregate($agg[0], $agg[1]);
        }

        if (!count($this->getFilter())) {
            return $q;
        }
        if (Schema::hasColumn($this->model->getTable(), 'user_id') && $this->byUser()) {
            $q->where('user_id', request()->user()->id);
        }
        $q = $this->byStatus($q);
        $q = $this->afterFilter($q);
        return $this->filterLike($q);
    }

    protected function byUser(): bool
    {
        return true;
    }

    private function byStatus(Builder $q): Builder
    {
        $filter = $this->getFilter();
        if (!isset($filter['status'])) {
            return $q;
        }
        if (self::STATUS()['All'] == $filter['status'] ?? null) {
            $q->withTrashed();
        } elseif (self::STATUS()['Inactive'] == $filter['status'] ?? null) {
            $q->onlyTrashed();
        }
        return $q;
    }

    public function filterLike(Builder $q): Builder
    {
        $likes = array_intersect_key($this->getFilter(), static::LIKES());
        foreach ($likes as $key => $val) {
            if (count([$rel, $col] = explode('.', static::LIKES()[$key])) > 1) {
                $q->whereHas($rel, function ($query) use ($col, $val) {
                    $query->where($col, 'like', "%$val%");
                });
            } else {
                $q->where(static::LIKES()[$key], 'like', "%$val%");
            }
        }
        return $q;
    }

    protected function afterFilter(Builder $q): Builder
    {
        return $q;
    }
}
