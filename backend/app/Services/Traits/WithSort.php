<?php

namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithSort
{
    protected static array $customSorts = [];
    abstract protected static function COLS(): array;

    public static function SORT(): array
    {
        $cols = [];
        foreach (static::COLS() as $key => $val) {
            $cols[$key] = [$val, 'asc'];
            $cols["-$key"] = [$val, 'desc'];
        }
        return $cols;
    }

    protected function preSortAggregate(): array
    {
        return [];
    }

    protected function sorts(): Builder
    {
        $q = $this->filters();
        $q = $this->preSort($q);
        foreach ($this->preSortAggregate() as $agg) {
            $q->withAggregate($agg[0], $agg[1]);
        }
        $sort = $this->params['sort'] ?? null;
        if (isset($sort)) {
            if (in_array(ltrim($sort, '-'), static::$customSorts)) {
                return $this->customSort($q);
            }
            [$cols, $dir] = static::SORT()[$sort];
            foreach ($cols as $col) {
                $q->orderBy($col, $dir);
            }
        }
        return $this->afterSort($q);
    }

    protected function preSort(Builder $q): Builder
    {
        return $q;
    }

    protected function afterSort(Builder $q): Builder
    {
        return $q;
    }

    protected function customSort(Builder $q): Builder
    {
        return $q;
    }
}
