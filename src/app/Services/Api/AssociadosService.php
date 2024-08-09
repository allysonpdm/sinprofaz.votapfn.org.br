<?php

namespace App\Services\Api;

use App\Models\Sinprofaz\Associados;
use ArchCrudLaravel\App\Services\BaseService;
use App\Enums\TiposAssociados;
use App\Http\Resources\Associados\AssociadosCollection;
use App\Http\Resources\Associados\AssociadosResource;
use Exception;
use Illuminate\Http\Response;
use stdClass;

class AssociadosService extends BaseService
{
    protected $nameModel = Associados::class;
    protected $nameCollection = AssociadosCollection::class;
    protected $nameResource = AssociadosResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationships($this->model);
    }

    public function isAutorizado(array $request): Response
    {
        $canVote = TiposAssociados::canVote();
        try{
            $associado = Associados::where(function($query) use ($request, $canVote){
                $query->where([
                    'cpf' => $request['cpf']
                ])
                ->where(function($query) use ($canVote){
                    foreach($canVote as $key => $type){
                        $query = ($key == 0)
                            ? $query->where(['status_filiado' => $type->value])
                            : $query->orWhere(['status_filiado' => $type->value]);
                    }
                    return $query;
                });
                return $query;
            })
            ->orWhere(function($query) use ($request, $canVote) {
                $query->where([
                    'cpf' => aplicarMascara($request['cpf'], '###.###.###-##')
                ])
                ->where(function($query) use ($canVote){
                    foreach($canVote as $key => $type){
                        $query = ($key == 0)
                            ? $query->where(['status_filiado' => $type->value])
                            : $query->orWhere(['status_filiado' => $type->value]);
                    }
                    return $query;
                });
                return $query;
            })
            ->firstOrFail();
            return response(new AssociadosResource($associado), 200);
        } catch (Exception $exception){
            #return $this->exceptionTreatment($exception);
            $response = new stdClass;
            $response->errors = ['cpf' => __('auth.failed')];

            return response(json_encode($response), 403);
        }
    }
}
