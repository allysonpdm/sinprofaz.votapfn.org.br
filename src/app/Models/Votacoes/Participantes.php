<?php

namespace App\Models\Votacoes;

use ArchCrudLaravel\App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participantes extends BaseModel
{
    use HasFactory;

    public $table = 'participantes';

    protected $fillable = [
        'sufragioId',
        'cpf',
        'votouEm',
        'ip'
    ];
}
