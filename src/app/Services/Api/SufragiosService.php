<?php

namespace App\Services\Api;

use App\DataTransferObjects\Emails\ComprovanteEmail;
use App\DataTransferObjects\Relatorio\Pdf as RelatorioPdf;
use App\Exceptions\CreateException;
use App\Exceptions\UpdateException;
use App\Http\Resources\Votacoes\Sufragios\{
    SufragiosCollection,
    SufragiosResource
};
use App\Mailer\SistemaMailer;
use App\Models\Votacoes\{
    Participantes,
    Questoes,
    Respostas,
    Sufragios
};
use ArchCrudLaravel\App\Services\BaseService;
use Dompdf\{
    Dompdf,
    Options
};
use Exception;
use Illuminate\Http\Response;

class SufragiosService extends BaseService
{
    protected ?string $nameModel = Sufragios::class;
    protected ?string $nameCollection = SufragiosCollection::class;
    protected ?string $nameResource = SufragiosResource::class;

    public function __construct()
    {
        parent::__construct();
        $this->relationships = self::getRelationshipNames($this->model);
    }

    public function votar(array $request): Response
    {
        try{
            $this->transaction();
            $this->iterarQuestoes($request['questoes']);
            $this->registrarParticipante(
                cpf: $request['cpf'],
                sufragioId: $request['sufragioId'],
                ip: $request['ip']
            );

            $comprovante = new ComprovanteEmail(
                destinatario: $request['email'],
                nome: $request['nome'],
                ip: $request['ip'],
                cpf: $request['cpf'],
                dataHora: $this->now,
                sufragioId: $request['sufragioId'],
                votos: $request['questoes'],
            );

            $provider = config('app.mailer_provider');
            $mailer = new SistemaMailer(new $provider, $comprovante->toEmail());
            $mailer->smtp();

            $this->commit();
            return response($comprovante->toArray(), 200);
        }catch(Exception $exception){
            return $this->exceptionTreatment($exception);
        }
    }

    private function iterarQuestoes(array $questoes): void
    {
        foreach ($questoes as $questao){
            $this->iterarRespostas(
                respostas: $questao['respostas'],
                limite: self::getLimiteEscolhas($questao['id'])
            );
        }
    }

    private function iterarRespostas(array $respostas, int $limite): void
    {
        $escolhas = 0;
        foreach ($respostas as $opcao){
            if($escolhas < $limite){
                $opcao = Respostas::find($opcao['id']);
                $opcao->increment('votos');
                $escolhas++;
            }
        }
    }

    private static function getLimiteEscolhas(int $questaoId)
    {
        return Questoes::find($questaoId)->limiteEscolhas;
    }

    private function registrarParticipante(string $cpf, int $sufragioId, string $ip): Participantes
    {
        return Participantes::create([
            'cpf' => $cpf,
            'sufragioId' => $sufragioId,
            'votouEm' => $this->now,
            'ip' => $ip
        ]);
    }

    public function relatorioDownload(int $id)
    {
        try {

            $sufragio = Sufragios::findOrFail($id);

            $dompdf = new Dompdf();
            $modelo = new RelatorioPdf($sufragio);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->setOptions(new Options([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'chroot' => public_path('storage/images'),
            ]));
            $dompdf->loadHtml($modelo->html());
            $dompdf->render();

            return response($dompdf->stream(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment',
                'filename' => 'participantes.pdf'
            ]);
        }catch(Exception $exception){
            return $this->exceptionTreatment($exception);
        }
    }

    public function relatorio(int $id)
    {
        try {

            $sufragio = Sufragios::findOrFail($id);

            return view(
                'A4.Portrait.Relatorio',
                [
                    'sufragio' => $sufragio
                ]
            );
        }catch(Exception $exception){
            return $this->exceptionTreatment($exception);
        }
    }

    protected function insert()
    {
        if (empty($this->request)) {
            throw new CreateException;
        }
        $this->model = $this->model::create($this->request);

        if(!empty($this->request['restricoes'])){
            foreach($this->request['restricoes'] as $restricao){
                $this->model->restricoes()->create($restricao);
            }
        }

        return $this;
    }

    protected function modify()
    {
        if (empty($this->request)) {
            throw new UpdateException;
        }

        if (
            array_key_exists($this->model::DELETED_AT, $this->request) &&
            $this->request[$this->model::DELETED_AT] === null &&
            $this->register->{$this->model::DELETED_AT} !== $this->request[$this->model::DELETED_AT]
        ) {
            $this->reactivate();
        }
        $this->register->update($this->request);

        if(!empty($this->request['restricoes'])){
            $this->register->restricoes()->delete();

            foreach($this->request['restricoes'] as $restricao){
                $this->register->restricoes()->create($restricao);
            }
        }

        return $this;
    }

}
