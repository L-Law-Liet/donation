<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\Api\StoreRequest;
use App\Http\Requests\Api\UpdateRequest;
use App\Services\ApiService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    protected ApiService $service;

    public function __construct()
    {
        app()->bind(Model::class, $this->model());
        $this->service = new ($this->service())(app($this->model()));
        app()->bind(IndexRequest::class, $this->indexRequest());
        app()->bind(StoreRequest::class, $this->storeRequest());
        app()->bind(UpdateRequest::class, $this->updateRequest());
    }

    abstract protected function model(): string;
    abstract protected function service(): string;
//    abstract protected function resource(): string;
    abstract protected function storeRequest(): string;
    abstract protected function updateRequest(): string;
    abstract protected function indexRequest(): string;

    /**
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $this->service->setParams($request->validated());
        return response()->json($this->service->all());
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request->validated()));
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return response()->json($this->service->show($id));
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
