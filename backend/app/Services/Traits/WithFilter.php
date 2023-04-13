<?php

namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

trait WithFilter
{
    /**
     * @return string[]
     */
    public static function STATUS(): array
    {
        return [
            'Active' => 'Active',
            'Inactive' => 'Inactive',
            'All' => 'All',
        ];
    }

    /**
     * @return array
     */
    public static function LIKES(): array
    {
        return [];
    }

    /**
     * @return Builder
     */
    private function query(): Builder
    {
        return $this->model->query();
    }

    /**
     * @return array
     */
    protected function preFilter(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function preFilterAggregate(): array
    {
        return [];
    }

    /**
     * @return Builder
     */
    protected function filters(): Builder
    {
        $q = $this->query()->with($this->preFilter());

        foreach ($this->preFilterAggregate() as $agg) {
            $q->withAggregate($agg[0], $agg[1]);
        }

        if (!isset($this->params['filter'])) {
            return $q;
        }
        if (Schema::hasColumn($this->model->getTable(), 'user_id') && $this->byUser()) {
            $q->where('user_id', request()->user()->id);
        }
        $q = $this->byStatus($q);
        return $this->filterLike($q);
    }

    /**
     * @return bool
     */
    protected function byUser(): bool
    {
        return true;
    }

    /**
     * @param Builder $q
     * @return Builder
     */
    private function byStatus(Builder $q): Builder
    {
        $filter = $this->params['filter'];
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

    /**
     * @param Builder $q
     * @return Builder
     */
    public function filterLike(Builder $q): Builder
    {
        $likes = array_intersect_key($this->params['filter'], static::LIKES());
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
}
