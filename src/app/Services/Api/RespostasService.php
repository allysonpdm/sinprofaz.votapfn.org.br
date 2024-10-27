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
    protected ?string $nameModel = Respostas::class;
    protected ?string $nameCollection = RespostasCollection::class;
    protected ?string $nameResource = RespostasResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationshipNames($this->model);
        $this->onCache = false;
    }

}
