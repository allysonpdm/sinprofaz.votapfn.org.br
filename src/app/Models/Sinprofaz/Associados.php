<?php

namespace App\Models\Sinprofaz;

use App\Http\Resources\Associados\AssociadosResource;
use ArchCrudLaravel\App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Associados extends BaseModel
{
    use HasFactory;
    protected $connection = 'mysql_area_filiado';
    public $table = 'usuarios';
    public static $searchable = [
        'id',
        'nome',
        'cpf'
    ];
    protected $hidden = [
        'id_usuario',
        'status_filiado',
        'siape',
        'senha',
        'aceite_email',
        'forma_pagamento',
        'data_registro',
        'ip_registro',
        'data_ultimo_acesso',
        'ultima_desfiliacao',
        'rg',
        'data_nascimento',
        'estado_civil',
        'naturalidade',
        'nacionalidade',
        'sexo',
        'pai',
        'mae',
        'tel_residencial',
        'tel_celular',
        'tel_celular2',
        'endereco',
        'uf',
        'bairro',
        'cidade',
        'cep',
        'complemento',
        'categoria',
        'situacao',
        'lotacao',
        'uf_lotacao',
        'telefone_funcional',
        'fax_funcional',
        'email_funcional',
        'data_posse',
        'membro_diretoria',
        'membro_diretoria2',
        'obs',
        'registro_oab'
    ];

    public function mapInto(): AssociadosResource
    {
        return new AssociadosResource($this);
    }
}
