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
        $this->dataHora = date('d/m/Y H:i:s', strtotime($this->dataHora));
        $this->cpf = "{$this->cpf[0]}{$this->cpf[1]}{$this->cpf[2]}.{$this->cpf[3]}{$this->cpf[4]}{$this->cpf[5]}.{$this->cpf[6]}{$this->cpf[7]}{$this->cpf[8]}-{$this->cpf[9]}{$this->cpf[10]}";
        $this->votos = self::votos($this->votos);
    }

    public function toEmail(): MailInterface
    {
        $assunto = "Comprovante de voto";

        return new Mail(
            remetente: new Remetente(),
            destinatario: new Destinatario(email: $this->destinatario),
            assunto: $assunto,
            msgHtml: "<div style=\"font-size:15px;\">
                <p>{$this->nome}, segue abaixo o seu comprovante de votação:</p>
                <p>Comprovante de votação:</p>
                    <b>CPF:</b> {$this->cpf}<br>
                    <b>Data e hora:</b> {$this->dataHora}<br>
                    <b>IP:</b> {$this->ip}<br>
                    <b>Votação:</b> {$this->votos}
                <br><br>
                <p>Atenciosamente,</p>
                <p>Sistema de votação do SINPROFAZ</p>
            </div>"
        );
    }

    public function votos(mixed $votos): string
    {
        $sufragio = Sufragios::find($this->sufragioId);
        $str = null;
        $str = "<b>{$sufragio->nome} {$sufragio->subtitulo}</b>";
        $str .= "<ul><b>Pergunta:</b>";
        foreach ($votos as $questao){
            $str .= "<li>" .
                Questoes::find($questao['id'])->label .
                "<br><b>Voto do participante:</b>";
            $str .= "<ul>";
            foreach($questao['respostas'] as $resposta){
                $str .= "<li>" . Respostas::find($resposta['id'])->label . "</li>";
            }
            $str .= "</ul>
            </li>";
        }
        $str .= "</ul>";
        return $str;
    }
}
