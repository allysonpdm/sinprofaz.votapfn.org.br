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
use PHPMailer\PHPMailer\SMTP;
use Spatie\DataTransferObject\DataTransferObject;

class ComprovanteEmail extends DataTransferObject
{
    public function __construct(
        public string $destinatario,
        public string $nome,
        public string $cpf,
        public string $dataHora,
        public string $ip,
        public string $sufragioId,
        public mixed $votos,
    ) {
        $this->dataHora = date('d/m/Y \à\s H:i:s', strtotime($this->dataHora));
        $this->cpf = "{$this->cpf[0]}{$this->cpf[1]}{$this->cpf[2]}.{$this->cpf[3]}{$this->cpf[4]}{$this->cpf[5]}.{$this->cpf[6]}{$this->cpf[7]}{$this->cpf[8]}-{$this->cpf[9]}{$this->cpf[10]}";
    }

    public function toEmail(): MailInterface
    {
        $assunto = "Comprovante de votação";
        $sufragio = Sufragios::find($this->sufragioId);

        return new Mail(
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
