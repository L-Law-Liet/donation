<?php

namespace App\Services;

use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Builder;

class CampaignService extends ApiService
{

    const STATUSES = [
        'Active' => 'Active',
        'Inactive' => 'Inactive',
        'All' => 'All',
    ];

    const SORT = [
        'num',
        'name',
        'friendly_name',
        '-num',
        '-name',
        '-friendly_name',
    ];

    protected function model(): string
    {
        return Campaign::class;
    }
    protected function resource(): string
    {
        return CampaignResource::class;
    }

    protected function indexRels(): array
    {
        return ['campaign'];
    }

    /**
     * @return Builder
     */
    protected function filters(): Builder
    {
        $q = parent::filters();
        if (!isset($this->params['filter'])) {
            return $q;
        }
        $filter = $this->params['filter'];
        if ($where = $filter['name'] ?? null) {
            $q->where('name', 'like', "%$where%");
        }
        if ($where = $filter['friendly_name'] ?? null) {
            $q->where('friendly_name', 'like', "%$where%");
        }
        if (self::STATUSES['All'] == $filter['status'] ?? null) {
            $q->withTrashed();
        } elseif (self::STATUSES['Inactive'] == $filter['status'] ?? null) {
            $q->onlyTrashed();
        }
        return $q;
    }

    /**
     * @return Builder
     */
    protected function sorts(): Builder
    {
        $q = $this->filters();
        if ($sort = $this->params['sort'] ?? null) {
            if (str_contains($sort, '-')) {
                $sort = str_replace('-', '', $sort);
                $q->orderBy($sort, 'desc');
            } else {
                $q->orderBy($sort);
            }
        }
        return $q;
    }

}
