<?php

namespace App\Http\Resources\Votacoes\Arquivos;

use App\Http\Resources\BaseResource;
use Illuminate\Support\Arr;

class ArquivosResource extends BaseResource
{
    protected $route = 'arquivos';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data = self::sanitize(
            $data,
            [
                $this->resource::UPDATED_AT,
                $this->resource::CREATED_AT,
            ]
        );

        return [
            ...$data
        ];
    }
}
