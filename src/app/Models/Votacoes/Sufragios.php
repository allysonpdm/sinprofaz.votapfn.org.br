<?php

namespace App\Models\Votacoes;

use App\Http\Resources\Votacoes\Sufragios\SufragiosResource;
use ArchCrudLaravel\App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sufragios extends BaseModel
{
    use HasFactory;

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
    public const DELETED_AT = 'deletedAt';
    public $table = 'sufragios';
    public array $searchable = [
        'id',
        'nome',
        'descricao',
        'subtitulo',
        'inicio',
        'fim',
    ];
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'subtitulo',
        'inicio',
        'fim',
        self::DELETED_AT,
    ];

    public function questoes(): HasMany
    {
        return $this->hasMany(Questoes::class, 'sufragioId');
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participantes::class,'sufragioId');
    }

    public function arquivos(): HasMany
    {
        return $this->hasMany(Arquivos::class,'sufragioId');
    }

    public function restricoes(): HasMany
    {
        return $this->hasMany(Restricao::class,'sufragioId');
    }

    public function mapInto(): SufragiosResource
    {
        return new SufragiosResource($this);
    }
}
