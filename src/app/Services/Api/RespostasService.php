<?php

namespace App\Services\Api;


use App\Http\Resources\Votacoes\Respostas\RespostasCollection;
use App\Http\Resources\Votacoes\Respostas\RespostasResource;
use App\Models\Votacoes\{
    Respostas,
};
use ArchCrudLaravel\App\Services\BaseService;

class RespostasService extends BaseService
{
    protected $nameModel = Respostas::class;
    protected $nameCollection = RespostasCollection::class;
    protected $nameResource = RespostasResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationships($this->model);
    }

}
