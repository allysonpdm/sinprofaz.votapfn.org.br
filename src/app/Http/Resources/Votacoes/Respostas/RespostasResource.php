<?php

namespace App\Http\Resources\Votacoes\Respostas;

use App\Http\Resources\BaseResource;
use Illuminate\Support\Arr;

class RespostasResource extends BaseResource
{
    protected $route = 'respostas';
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
                'questaoId',
                $this->resource::UPDATED_AT,
                $this->resource::CREATED_AT,
            ]
        );

        return $data;
    }
}
