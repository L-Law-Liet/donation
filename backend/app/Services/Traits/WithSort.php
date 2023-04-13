<?php

namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithSort
{
    public static function SORT(): array
    {
        return [];
    }

    protected function preSort(): array
    {
        return [];
    }

    protected function preSortAggregate(): array
    {
        return [];
    }

    /**
     * @return Builder
     */
    protected function sorts(): Builder
    {
        $q = $this->filters()
            ->with($this->preSort());
        foreach ($this->preSortAggregate() as $agg) {
            $q->withAggregate($agg[0], $agg[1]);
        }
        if (isset($this->params['sort'])) {
            [$cols, $dir] = static::SORT()[$this->params['sort']];
            foreach ($cols as $col) {
                $q->orderBy($col, $dir);
            }
        }
        return $q;
    }
}
