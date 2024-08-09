<?php

namespace App\Http\Requests\Respostas;

use App\Models\Votacoes\Respostas;
use ArchCrudLaravel\App\Http\Requests\BaseRequest;

abstract class RespostasRequest extends BaseRequest
{
    protected $model = Respostas::class;

    protected function hasGroupPermission(): bool
    {
        return false;
    }

    protected function isOwner(string $method): bool
    {
        return false;
    }
}
