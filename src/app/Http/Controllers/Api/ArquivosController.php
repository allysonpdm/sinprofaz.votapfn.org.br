<?php

namespace App\Http\Controllers\Api;

use ArchCrudLaravel\App\Http\Controllers\BaseController;
use App\Http\Requests\Arquivos\{
    DeleteRequest,
    IndexRequest,
    ShowRequest,
    StoreRequest,
    UpdateRequest
};
use App\Services\Api\ArquivosService;
use Illuminate\Http\Response;

class ArquivosController extends BaseController
{
    protected $nameService = ArquivosService::class;

    public function store(StoreRequest $request): Response
    {
        return $this->service->store($request->validated());
    }

    public function index(IndexRequest $request): Response
    {
        return $this->service->index($request->validated());
    }

    public function show(ShowRequest $request, int $id): Response
    {
        return $this->service->show($request->validated(), $id);
    }

    public function update(UpdateRequest $request, int $id): Response
    {
        return $this->service->update($request->validated(), $id);
    }

    public function destroy(DeleteRequest $request, int $id): Response
    {
        return $this->service->destroy($request->validated(), $id);
    }
}