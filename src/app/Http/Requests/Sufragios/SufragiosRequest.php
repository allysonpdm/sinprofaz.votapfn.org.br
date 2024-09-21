<?php

namespace App\Http\Requests\Sufragios;

use App\Models\Votacoes\Sufragios;
use ArchCrudLaravel\App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\{
    Auth,
    Gate
};

abstract class SufragiosRequest extends BaseRequest
{
    protected string $model = Sufragios::class;

    protected function hasGroupPermission(): bool
    {
        return false;
    }

    protected function isOwner(string $method): bool
    {
        return false;
    }
}
