<?php

namespace App\Services;

use App\Services\Traits\WithParams;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

abstract class ApiService
{
    use WithParams;

    protected $rels = [];

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

    public function store(array $validated)
    {
        foreach ($validated as $key => $val) {
            if (is_array($val)) {
                $this->rels[$key] = $val;
                unset($validated[$key]);
            }
        }
        $model = $this->model->create($validated);
        $this->createRels($model);
        return new ($this->resource())(
            $model->load($this->load())
        );
    }

    protected function createRels(Model $model)
    {
        foreach ($this->rels as $key => $val) {
            $rel = $model->{$key}();
            if ($rel instanceof BelongsToMany) {
                $rel->attach($val);
            } elseif ($rel instanceof HasMany) {
                $rel->createMany($val);
            }
        }
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
