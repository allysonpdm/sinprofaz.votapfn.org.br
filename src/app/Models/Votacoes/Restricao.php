<?php

namespace App\Models\Votacoes;

use ArchCrudLaravel\App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restricao extends BaseModel
{
    use HasFactory;

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
    public const DELETED_AT = 'deletedAt';

    public $table = 'restricoes';

    protected $fillable = [
        'sufragioId',
        'column',
        'value',
    ];
}
