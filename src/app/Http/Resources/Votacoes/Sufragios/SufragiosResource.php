<?php

namespace App\Http\Resources\Votacoes\Sufragios;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Votacoes\Questoes\QuestoesCollection;
use Illuminate\Support\Arr;

class SufragiosResource extends BaseResource
{
    protected $route = 'sufragios';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data = self::sanitize($data, []);

        return [
            ...$data,
            '@inicio' => date('d/m/Y H:i:s', strtotime($this->inicio)),
            '@fim' => date('d/m/Y H:i:s', strtotime($this->fim)),
            'questoes' => array_values((new QuestoesCollection($this->whenLoaded('questoes')))->sortBy('id')->toArray()),
        ];
    }
}
