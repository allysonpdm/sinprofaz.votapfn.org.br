<?php

namespace App\Http\Requests\Arquivos;

use App\Models\Votacoes\Arquivos;
use ArchCrudLaravel\App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\{
    Auth,
    Gate
};

abstract class ArquivosRequest extends BaseRequest
{
    protected $model = Arquivos::class;

    protected function hasGroupPermission(): bool
    {
        return false;
    }

    protected function isOwner(string $method): bool
    {
        return false;
    }
}
