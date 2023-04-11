<?php

namespace App\Services;

use App\Http\Resources\ApiResource;
use Illuminate\Database\Eloquent\Model;

abstract class ApiService
{
    protected Model $model;

    public function __construct()
    {
        app()->bind(Model::class, $this->model());
        app()->bind(ApiResource::class, $this->resource());
    }

    abstract protected function model(): string;
    abstract protected function resource(): string;

    public function all()
    {
        return $this->model->all();
    }

    public function store()
    {

    }
}
