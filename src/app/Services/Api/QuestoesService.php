<?php

namespace App\Services\Api;

use App\Http\Resources\Votacoes\Questoes\QuestoesCollection;
use App\Http\Resources\Votacoes\Questoes\QuestoesResource;
use App\Models\Votacoes\{
    Questoes,
};
use ArchCrudLaravel\App\Services\BaseService;
use ArchCrudLaravel\App\Services\Traits\Relationships;

class QuestoesService extends BaseService
{
    protected ?string $nameModel = Questoes::class;
    protected ?string $nameCollection = QuestoesCollection::class;
    protected ?string $nameResource = QuestoesResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationshipNames($this->model);
    }

}
