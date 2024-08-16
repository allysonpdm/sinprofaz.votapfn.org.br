<?php

namespace App\Http\Controllers\Api;

use ArchCrudLaravel\App\Http\Controllers\BaseController;
use App\Http\Requests\Sufragios\{
    DeleteRequest,
    IndexRequest,
    RelatorioRequest,
    ShowRequest,
    StoreRequest,
    UpdateRequest,
    VotarRequest
};
use App\Services\Api\SufragiosService;
use Illuminate\Http\Response;

class SufragiosController extends BaseController
{
    protected $nameService = SufragiosService::class;

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

    public function votar(VotarRequest $request): Response
    {
        return $this->service->votar([
            ...$request->validated(),
            'ip' => $request->ip()
        ]);
    }

    public function relatorio(int $id): Response
    {
        return $this->service->relatorio($id);
    }

    public function emAndamento(IndexRequest $request): Response
    {
        $now = now()->format('Y-m-d H:i:s');
        $request = $request->validated();
        $request['wheres'] = [
            [
                'column' => 'inicio',
                'condition' => '<=',
                'search' => $now,
            ],
            [
                'column' => 'fim',
                'condition' => '>=',
                'search' => $now,
            ]
        ];
        return $this->service->index($request);
    }

    public function encerradas(IndexRequest $request): Response
    {
        $now = now()->format('Y-m-d H:i:s');
        $request = $request->validated();
        $request['wheres'] = [
            [
                'column' => 'fim',
                'condition' => '<=',
                'search' => $now,
            ]
        ];
        return $this->service->index($request);
    }
}
