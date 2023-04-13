<?php

namespace App\Services;

use App\Services\Traits\WithParams;
use Illuminate\Database\Eloquent\Model;

abstract class ApiService
{
    use WithParams;

    public function __construct(protected Model $model) {}

    abstract protected function model(): string;
    abstract protected function resource(): string;
    abstract protected function collection(): string;

    public function all()
    {
        $records = new ($this->collection())(
            $this->sorts()->with($this->with())->paginate($this->params['per_page'] ?? null)
        );
        return $records->response()->getData(true);
    }

    public function store()
    {

    }

    public function show(string $id)
    {
        return new ($this->resource())(
            $this->model->findOrFail($id)->load($this->load())
        );
    }

    /**
     * @return array
     */
    protected function with(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function load(): array
    {
        return [];
    }
}
