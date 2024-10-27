<?php

namespace App\DataTransferObjects\Emails;

use App\Models\Votacoes\Questoes;
use App\Models\Votacoes\Respostas;
use App\Models\Votacoes\Sufragios;
use ArchSendMailLaravel\Mailer\Infos\{
    Destinatario,
    Mail,
    MailInterface,
    Remetente
};
use InvalidArgumentException;
use Spatie\DataTransferObject\DataTransferObject;

class Comprovante extends DataTransferObject
{
    public function __construct(
        public string $nome,
        public string $cpf,
        public string $dataHora,
        public string $ip,
        public string $sufragioId,
        public mixed $votos,
        public ?string $destinatario = null
    ) {
        $this->dataHora = $this->formatarDataHora($this->dataHora);
        $this->cpf = $this->formatarCpf($this->cpf);
    }

    private function formatarDataHora(string $dataHora): string
    {
        return date(format: 'd/m/Y \à\s H:i:s', timestamp: strtotime(datetime: $dataHora));
    }

    private function formatarCpf(string $cpf): string
    {
        return preg_replace(pattern: "/^(\d{3})(\d{3})(\d{3})(\d{2})$/", replacement: "$1.$2.$3-$4", subject: $cpf);
    }

    public function toEmail(): MailInterface
    {
        if(empty($this->destinatario)){
            throw new InvalidArgumentException(message: 'O destinatário não especificado.');
        }

        $assunto = "Comprovante de votação";
        $sufragio = Sufragios::find($this->sufragioId);

        return new Mail(
            SMTPDebug: 4,
            remetente: new Remetente(nome: 'Vota PFN - SINPROFAZ'),
            destinatario: new Destinatario(email: $this->destinatario),
            assunto: $assunto,
            msgHtml: view('emails.comprovante', [
                'nome' => $this->nome,
                'cpf' => $this->cpf,
                'dataHora' => $this->dataHora,
                'ip' => $this->ip,
                'votos' => $this->votos,
                'votacao' => $sufragio,
            ])->render()
        );
    }
}
