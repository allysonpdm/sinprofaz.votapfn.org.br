<?php

namespace App\Services\Api;

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
    protected $nameModel = Arquivos::class;
    protected $nameCollection = ArquivosCollection::class;
    protected $nameResource = ArquivosResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationships($this->model);
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

    public function beforeDelete($id){
        $arquivo = Arquivos::find($id);
        unlink(public_path('pdfs') . "/$arquivo->sufragioId/{$arquivo->filename}");
        return $this;
    }

}
