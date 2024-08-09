<?php

namespace App\Http\Resources\Associados;

use App\Enums\TiposAssociados;
use App\Http\Resources\BaseResource;
use Illuminate\Support\{
    Arr,
    Str
};

class AssociadosResource extends BaseResource
{
    protected $route = 'associados';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data = self::sanitize($data, ['@url']);

        return Arr::sortRecursive([
            ...$data,
            'cpf' => Str::replace(['.', '-'], '',$this->cpf),
            'cod_tipo_associado' => TiposAssociados::getName($this->status_filiado),
        ]);
    }
}
