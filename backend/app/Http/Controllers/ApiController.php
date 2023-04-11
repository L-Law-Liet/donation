<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\Api\StoreRequest;
use App\Http\Requests\Api\UpdateRequest;
use App\Http\Resources\ApiResource;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
abstract class ApiController extends Controller
{
    protected ApiService $service;

    public function __construct()
    {
        app()->singleton(ApiService::class, $this->service());
        app()->bind(Model::class, $this->model());
        app()->bind(IndexRequest::class, $this->indexRequest());
        app()->bind(StoreRequest::class, $this->storeRequest());
        app()->bind(UpdateRequest::class, $this->updateRequest());
    }

    abstract protected function model(): string;
    abstract protected function service(): string;
    abstract protected function storeRequest(): string;
    abstract protected function updateRequest(): string;
    abstract protected function indexRequest(): string;

    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        return $this->service->all();
    }

    /**
     * @param StoreRequest $request
     * @return void
     */
    public function store(StoreRequest $request)
    {
        dd(1);
    }

    /**
     * @param Model $model
     * @return void
     */
    public function show(Model $model)
    {
        dd($model);
    }

    /**
     * @param UpdateRequest $request
     * @param string $id
     * @return void
     */
    public function update(UpdateRequest $request, string $id)
    {
        //
    }

    /**
     * @param Model $model
     * @return void
     */
    public function destroy(Model $model)
    {
        //
    }
}
