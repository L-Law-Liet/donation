<?php

namespace App\Services;

use App\Http\Resources\ApiResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

abstract class ApiService
{
    protected array $params = [];

    public function __construct(protected Model $model)
    {
    }

    abstract protected function model(): string;
    abstract protected function resource(): string;

    public function all()
    {
        return ($this->resource())
            ::collection(
                $this->sorts()->with($this->indexRels())->paginate($this->params['per_page'] ?? null)
            )->response()->getData(true);
    }

    public function store()
    {

    }

    public function show(string $id)
    {
        return new ($this->resource())($this->model->findOrFail($id));
    }

    /**
     * @return array
     */
    protected function indexRels(): array
    {
        return [];
    }

    /**
     * @return Builder
     */
    protected function filters(): Builder
    {
        $q = $this->query();
        if (Schema::hasColumn($this->model->getTable(), 'user_id') && $this->byUser()) {
            $q->where('user_id', request()->user()->id);
        }
        return $q;
    }

    /**
     * @return Builder
     */
    protected function sorts(): Builder
    {
        return $this->filters();
    }

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return Builder
     */
    private function query(): Builder
    {
        return $this->model->query();
    }

    protected function byUser(): bool
    {
        return true;
    }
}
