<?php

namespace App\Models\Votacoes;

use App\Http\Resources\Votacoes\Respostas\RespostasResource;
use ArchCrudLaravel\App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Respostas extends BaseModel
{
    use HasFactory;

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
    public const DELETED_AT = 'deletedAt';
    public $table = 'respostas';

    public array $searchable = [
        'questaoId',
        'label',
    ];
    protected $fillable = [
        'questaoId',
        'label',
        self::DELETED_AT
    ];


    public function questao(): BelongsTo
    {
        return $this->belongsTo(Questoes::class, 'questaoId');
    }

    public function mapInto(): RespostasResource
    {
        return new RespostasResource($this);
    }
}
