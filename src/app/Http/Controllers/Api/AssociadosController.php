<?php

namespace App\Http\Controllers\Api;

use ArchCrudLaravel\App\Http\Controllers\BaseController;
use App\Http\Requests\Associados\{
    IsAutorizadoRequest,
    ShowRequest,
};
use App\Services\Api\AssociadosService;
use Illuminate\Http\Response;

class AssociadosController extends BaseController
{
    protected $nameService = AssociadosService::class;

    public function isAutorizado(IsAutorizadoRequest $request): Response
    {
        return $this->service->isAutorizado($request->validated());
    }
}
