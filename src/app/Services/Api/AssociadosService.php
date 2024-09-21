<?php

namespace App\Services\Api;

use App\Models\Sinprofaz\Associados;
use ArchCrudLaravel\App\Services\BaseService;
use App\Enums\TiposAssociados;
use App\Http\Resources\Associados\AssociadosCollection;
use App\Http\Resources\Associados\AssociadosResource;
use App\Models\Votacoes\Sufragios;
use Exception;
use Illuminate\Http\Response;
use stdClass;

class AssociadosService extends BaseService
{
    protected ?string $nameModel = Associados::class;
    protected ?string $nameCollection = AssociadosCollection::class;
    protected ?string $nameResource = AssociadosResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationshipNames($this->model);
    }

    public function isAutorizado(array $request): Response
    {
        try {
            $canVote = TiposAssociados::canVote();
            $votacao = Sufragios::find($request['sufragioId']);
            $restricoes = $votacao->restricoes;

            $builder = Associados::where(function ($query) use ($request, $canVote, $restricoes) {
                $query->where('cpf', $request['cpf'])
                    ->whereIn('status_filiado', $canVote);

                if (!$restricoes->isEmpty()) {
                    $query->where(function ($query) use ($restricoes) {
                        $ufs = [];
                        foreach ($restricoes as $restricao) {
                            if ($restricao->column == 'uf_lotacao') {
                                $ufs[] = $restricao->value;
                            } else {
                                $query->where($restricao->column, $restricao->value);
                            }
                        }

                        if (!empty($ufs)) {
                            $query->whereIn('uf_lotacao', $ufs);
                        }
                    });
                }
            })
                ->orWhere(function ($query) use ($request, $canVote, $restricoes) {
                    $query->where('cpf', aplicarMascara($request['cpf'], '###.###.###-##'))
                        ->whereIn('status_filiado', $canVote);

                    if (!$restricoes->isEmpty()) {
                        $query->where(function ($query) use ($restricoes) {
                            $ufs = [];
                            foreach ($restricoes as $restricao) {
                                if ($restricao->column == 'uf_lotacao') {
                                    $ufs[] = $restricao->value;
                                } else {
                                    $query->where($restricao->column, $restricao->value);
                                }
                            }

                            if (!empty($ufs)) {
                                $query->whereIn('uf_lotacao', $ufs);
                            }
                        });
                    }
                });
            $associado = $builder->firstOrFail();

            return response(new AssociadosResource($associado), 200);
        } catch (Exception $exception) {
            $response = new stdClass;
            $response->errors = ['cpf' => __('auth.failed')];

            return response(json_encode($response), 403);
        }
    }
}
