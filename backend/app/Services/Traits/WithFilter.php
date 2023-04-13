<?php

namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Builder;
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
     * @return Builder
     */
    private function query(): Builder
    {
        return $this->model->query();
    }

    protected function preFilter(): array
    {
        return [];
    }

    /**
     * @return Builder
     */
    protected function filters(): Builder
    {
        $q = $this->query()->with($this->preFilter());
        if (!isset($this->params['filter'])) {
            return $q;
        }
        if (Schema::hasColumn($this->model->getTable(), 'user_id') && $this->byUser()) {
            $q->where('user_id', request()->user()->id);
        }
        return $this->byStatus($q);
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
}
