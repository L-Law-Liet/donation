<?php

namespace App\Services;

use App\Services\Traits\WithParams;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class ApiService
{
    use WithParams;

    public function __construct(protected Model $model) {}

    abstract protected function model(): string;
    abstract protected function resource(): string;
    abstract protected function collection(): string;

    public function all()
    {
        $q = $this->sorts();
        $records = new ($this->collection())(
            $q->with($this->with())
                ->paginate($this->params['per_page'] ?? null)
        );
        return $records->response()->getData(true);
    }

    public function store(array $validated): Model
    {
        return $this->model->create($validated);
    }

    public function show(string $id)
    {
        return new ($this->resource())(
            $this->model->findOrFail($id)
                ->load($this->load())
        );
    }

    protected function with(): array
    {
        return [];
    }

    protected function load(): array
    {
        return [];
    }
}
