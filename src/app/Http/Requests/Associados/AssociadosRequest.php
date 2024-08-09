<?php

namespace App\Http\Requests\Associados;

use App\Models\Sinprofaz\Associados;
use ArchCrudLaravel\App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\{
    Auth,
    Gate
};

abstract class AssociadosRequest extends BaseRequest
{
    protected $model = Associados::class;

    protected function hasGroupPermission(): bool
    {
        return false;
    }

    protected function isOwner(string $method): bool
    {
        return false;
    }
}
