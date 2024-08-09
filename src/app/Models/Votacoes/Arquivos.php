<?php

namespace App\Models\Votacoes;

use App\Http\Resources\Votacoes\Arquivos\ArquivosResource;
use ArchCrudLaravel\App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arquivos extends BaseModel
{
    use HasFactory;

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
    public const DELETED_AT = 'deletedAt';
    public $table = 'arquivos';
    public static $searchable = [
        'id',
        'sufragioId',
        'filename',
        'label',
        'mimeType',
        'extension',
        'size',
        self::DELETED_AT
    ];
    protected $fillable = [
        'sufragioId',
        'filename',
        'label',
        'mimeType',
        'extension',
        'size',
        self::DELETED_AT
    ];

    public function mapInto(): ArquivosResource
    {
        return new ArquivosResource($this);
    }
}
