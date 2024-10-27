<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Votação - SINPROFAZ</title>
</head>

<body
    style="font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 0; cursor:default;">
    <div
        style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="text-align: center; background-color: #333; padding: 10px; border-radius: 8px 8px 0 0;">
            <a href="https://sinprofaz.org.br" target="_blank" style="display: inline-block;">
                <img src="{{ config('app.url') . '/img/logoTopo.png' }}" alt="Logo Sistema de Votação SINPROFAZ"
                    style="width: 150px; height: auto;">
            </a>
        </div>
        <div style="margin: 20px 0; font-size: 16px; line-height: 1.6;">
            <h1 style="text-align: center; font-size: 24px; color: #333;">Comprovante de Votação</h1>
            <p>Prezado(a) {{ $nome }},</p>
            <p>Seu voto foi computado com sucesso. Este comprovante confirma sua participação na votação realizada pelo
                SINPROFAZ.</p>
            <p><b>Importante:</b> O seu voto é secreto. Sem este documento, não há nenhuma forma de associá-lo a você.<br>
                Os dados sobre a sua votação não serão armazenados para consulta futura, então, caso você
                precise de uma confirmação posterior, guarde este comprovante.</p>
            <p>Abaixo estão os detalhes da sua participação:</p>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 8px;"><b>CPF:</b> {{ $cpf }}</li>
                <li style="margin-bottom: 8px;"><b>Data e Hora:</b> {{ $dataHora }}</li>
                <li style="margin-bottom: 8px;"><b>Endereço IP:</b> {{ $ip }}</li>
                <li style="margin-bottom: 8px;"><b>ID votação:</b> {{ $votacao->id }}</li>
                <li style="margin-bottom: 8px;"><b>Votação:</b> {{ $votacao->nome }} {{ $votacao->subtitulo }}</li>
                @if(!empty($votos))
                    @foreach ($votacao->questoes as $key => $questao)
                        <ul style="list-style:decimal;">
                            <li>{{ $questao->label }}</li>
                            <ul style="list-style:none;">
                                @foreach ($votos[$key]['respostas'] as $voto)
                                    <li>
                                        <input type="checkbox" checked="checked" style="transform: scale(1.5); vertical-align: middle;">
                                        {{ App\Models\Votacoes\Respostas::where($voto)->first()->label }}
                                    </li>
                                @endforeach
                            </ul>
                        </ul>
                    @endforeach
                @endif
            </ul>
        </div>
        <div style="text-align: left; color: #777; font-size: 14px; margin-top: 20px;">
            <strong>Sistema de Votação do SINPROFAZ</strong><br>
            Essa é a <i>{{ $via }} via</i> do comprovante, e foi gerado em:<br>
            {{ date('d/m/Y \à\s H:i:s') }}
        </div>
    </div>
</body>

</html>
