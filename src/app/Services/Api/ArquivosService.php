<?php

namespace App\Services\Api;

use App\Exceptions\SoftDeleteException;
use App\Http\Resources\Votacoes\Arquivos\{
    ArquivosCollection,
    ArquivosResource
};
use App\Models\Votacoes\{
    Arquivos
};
use ArchCrudLaravel\App\Services\BaseService;
use Illuminate\Support\Str;

class ArquivosService extends BaseService
{
    protected ?string $nameModel = Arquivos::class;
    protected ?string $nameCollection = ArquivosCollection::class;
    protected ?string $nameResource = ArquivosResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationshipNames($this->model);
        $this->onCache = false;
    }

    protected function beforeInsert()
    {
        $filename = $this->request['file']->getClientOriginalName();
        $extension = $this->request['file']->extension();
        $filename = Str::replace('.' . $extension, null, $filename);

        $this->request['filename'] = Str::slug($filename) . '.' . $extension;
        $this->request['extension'] = $extension;
        $this->request['mimeType'] = $this->request['file']->getClientMimeType();
        $this->request['size'] = $this->request['file']->getSize();
        $this->request['file']->move("pdfs/{$this->request['sufragioId']}/", Str::slug($filename) . '.' . $extension);
        return $this;
    }

    public function deleteRecord()
    {
        if (!self::isActive($this->register, $this->model::DELETED_AT, $this->force)) {
            throw new SoftDeleteException;
        }

        unlink(public_path('pdfs') . "/{$this->register->sufragioId}/{$this->register->filename}");

        $this->model = self::hasRelationships($this->register)
            ? $this->softOrHardDelete(
                register: $this->register
            )
            : $this->register->delete();
        return $this;
    }

}
