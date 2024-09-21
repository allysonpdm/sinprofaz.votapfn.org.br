<?php

namespace App\Http\Requests\Questoes;

use App\Models\Votacoes\Questoes;
use ArchCrudLaravel\App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\{
    Auth,
    Gate
};

abstract class QuestoesRequest extends BaseRequest
{
    protected string $model = Questoes::class;

    protected function hasGroupPermission(): bool
    {
        return false;
    }

    protected function isOwner(string $method): bool
    {
        return false;
    }
}
