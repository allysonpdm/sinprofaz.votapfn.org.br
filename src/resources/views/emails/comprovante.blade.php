<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Votação - SINPROFAZ</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 0; cursor:default;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="text-align: center; background-color: #333; padding: 10px; border-radius: 8px 8px 0 0;">
            <a href="https://sinprofaz.org.br" target="_blank" style="display: inline-block;">
                <img src="{{ config('app.url') }}/img/logoTopo.png" alt="Logo Sistema de Votação SINPROFAZ" style="width: 150px; height: auto;">
            </a>
        </div>
        <div style="margin: 20px 0; font-size: 16px; line-height: 1.6;">
            <h1 style="text-align: center; font-size: 24px; color: #333;">Comprovante de Votação</h1>
            <p>Prezado(a) {{ $nome }},</p>
            <p>Seu voto foi computado com sucesso. Este comprovante confirma sua participação na votação realizada pelo SINPROFAZ.</p>
            <p><b>Importante:</b> seu voto é secreto e, sem este comprovante, ele não pode ser associado a você de forma alguma.</p>
            <p>Abaixo estão os detalhes da sua participação:</p>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 8px;"><b>CPF:</b> {{ $cpf }}</li>
                <li style="margin-bottom: 8px;"><b>Data e Hora:</b> {{ $dataHora }}</li>
                <li style="margin-bottom: 8px;"><b>Endereço IP:</b> {{ $ip }}</li>
                <li style="margin-bottom: 8px;"><b>ID votação:</b> {{ $votacao->id }}</li>
                <li style="margin-bottom: 8px;"><b>Votação:</b> {{ $votacao->nome }} {{ $votacao->subtitulo }}</li>
                <?php foreach ($votacao->questoes as $key => $questao) : ?>
                    <ul style="list-style:decimal;">
                        <li>{{ $questao->label }}</li>
                        <ul style="list-style:none;">
                            <?php foreach ($votos[$key]['respostas'] as $voto) :?>
                                <li><span style="color: #00ff00;">✔</span> {{ App\Models\Votacoes\Respostas::where($voto)->first()->label }}</li>
                            <?php endforeach;?>
                        </ul>
                    </ul>
                <?php endforeach; ?>
            </ul>
        </div>
        <div style="text-align: left; color: #777; font-size: 14px; margin-top: 20px;">
            <p>Atenciosamente,<br>Equipe do Sistema de Votação<br>SINPROFAZ</p>
        </div>
    </div>
</body>

</html>
