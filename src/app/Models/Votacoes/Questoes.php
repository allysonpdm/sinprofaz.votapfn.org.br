<?php

namespace App\Models\Votacoes;

use App\Http\Resources\Votacoes\Questoes\QuestoesResource;
use ArchCrudLaravel\App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questoes extends BaseModel
{
    use HasFactory;

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
    public const DELETED_AT = 'deletedAt';
    public $table = 'questoes';

    public static $searchable = [
        'sufragioId',
        'label',
        'complemento',
        'limiteEscolhas'
    ];
    protected $fillable = [
        'sufragioId',
        'label',
        'complemento',
        'limiteEscolhas',
        self::DELETED_AT
    ];

    public function respostas(): HasMany
    {
        return $this->hasMany(Respostas::class, 'questaoId');
    }

    public function mapInto(): QuestoesResource
    {
        return new QuestoesResource($this);
    }
}
