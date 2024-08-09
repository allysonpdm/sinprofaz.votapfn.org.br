<?php

namespace App\Http\Resources\Votacoes\Questoes;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Votacoes\Respostas\RespostasCollection;
use Illuminate\Support\Arr;

class QuestoesResource extends BaseResource
{
    protected $route = 'questoes';
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
            ...$data,
            'respostas' => array_values((new RespostasCollection($this->respostas))->sortBy('id')->toArray())
        ];
    }
}
