<?php

namespace App\Services\Api;

use App\Http\Resources\Votacoes\Questoes\QuestoesCollection;
use App\Http\Resources\Votacoes\Questoes\QuestoesResource;
use App\Models\Votacoes\{
    Questoes,
};
use ArchCrudLaravel\App\Services\BaseService;

class QuestoesService extends BaseService
{
    protected $nameModel = Questoes::class;
    protected $nameCollection = QuestoesCollection::class;
    protected $nameResource = QuestoesResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationships($this->model);
    }

}
