<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lista de Participantes - SINPROFAZ</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    @vite('resources/css/relatorio.css')
    @vite('resources/js/app.js')
    <style>
        .table th, .table td {
            border-color: #3c3c3c;
        }
        footer {
            margin-top: 30px;
        }
        section > p {
            margin: 0px 50px;
        }
    </style>
</head>

<body class="antialiased">
    <article>
        <div class="text-center bg-dark text-white py-4 rounded-top">
            <a href="https://sinprofaz.org.br" target="_blank">
                <img src="{{ config('app.url') }}/img/logoTopo.png" alt="Logo SINPROFAZ" style="width: 150px; height: auto;">
            </a>
            <h1 class="mt-3"><i class="fa-solid fa-check-to-slot"></i> Sistema de Votação SINPROFAZ</h1>
        </div>

        <div class="container my-5">
            <!-- Voting Details Section -->
            <section class="mb-5">
                <h2 class="mt-3"><i class="fa-solid fa-caret-right" style="color:#666;"></i> Sobre a Votação</h2>
                <p><strong>Título:</strong> {{ $sufragio->subtitulo }}</p>
                <p><strong>ID da Votação:</strong> {{ $sufragio->id }}</p>
                <p><strong>Descrição:</strong> {!! $sufragio->descricao !!}</p>

                <h3 class="mt-3"><i class="fa-solid fa-hourglass-half" style="color:#666;"></i> Período de Votação</h3>
                <p><strong>Início:</strong> {{ date('d/m/Y H:i:s', strtotime($sufragio->inicio)) }}</p>
                <p><strong>Fim:</strong> {{ date('d/m/Y H:i:s', strtotime($sufragio->fim)) }}</p>

                <h3 class="mt-3"><i class="fa-solid fa-circle-info" style="color:#666;"></i> Informações Adicionais</h3>
                <p><strong>Criada em:</strong> {{ date('d/m/Y H:i:s', strtotime($sufragio->created_at)) }}</p>
                <p><strong>Última Modificação:</strong> {{ date('d/m/Y H:i:s', strtotime($sufragio->updated_at)) }}</p>
                <p><strong>URL:</strong> <a href="{{ config('app.url') }}/votacao/{{ $sufragio->id }}" target="_blank">{{ config('app.url') }}/votacao/{{ $sufragio->id }}</a></p>

                @if ($sufragio->restricoes->isNotEmpty())
                    <h3 class="mt-3"><i class="fa-solid fa-ban" style="color:#666;"></i> Restrições Aplicadas</h3>
                    <p>Condições obrigatórias necessárias para partipar:</p>
                    <ul style="list-style: decimal; padding-left:100px;">
                        @foreach ($sufragio->restricoes as $restricao)
                            <li style="padding:0px 10px;"><strong>Coluna:</strong> "{{ $restricao->column }}" com <strong>valor:</strong> "{{ $restricao->value }}".</li>
                        @endforeach
                    </ul>
                @endif
            </section>

            <!-- Questionnaire Section -->
            <section class="mb-5">
                <h2><i class="fa-solid fa-caret-right" style="color:#666;"></i> Questionário</h2>
                @if ($sufragio->questoes->isEmpty())
                    <p>Não houve questionários.</p>
                @else
                    @foreach ($sufragio->questoes->sortBy('id') as $questao)
                        <p><strong>Pergunta:</strong> {{ $questao->label }}</p>
                        <p><strong>ID:</strong> {{ $questao->id }}</p>
                        <p><strong>Descrição:</strong> {{ $questao->complemento }}</p>
                        <p><b>Opções:</b></p>
                        <table class="table table-striped" style="margin:0px 50px;">
                            <thead>
                                <tr>
                                    <th style="width: 30px;"></th>
                                    <th>ID</th>
                                    <th>Texto</th>
                                    <th>Votos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Encontrar a resposta com mais votos
                                    $respostaMaisVotada = $questao->respostas->sortByDesc('votos')->first();
                                @endphp
                                @foreach ($questao->respostas as $resposta)
                                    <tr>
                                        <td>
                                            @if ($resposta->id == $respostaMaisVotada->id)
                                                <i class="fa-solid fa-star" style="color:#666"></i>
                                            @endif
                                        </td>
                                        <td>{{ $resposta->id }}</td>
                                        <td>{{ $resposta->label }}</td>
                                        <td>{{ $resposta->votos }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p><strong>Total de Votos:</strong> {{ $questao->respostas->sum('votos') }}</p>
                    @endforeach
                @endif
            </section>

            <!-- Participants Section -->
            <section class="mb-5">
                <h2><i class="fa-solid fa-caret-right" style="color:#666;"></i> Participantes</h2>
                @if ($sufragio->participantes->isEmpty())
                    <p>Não houve participantes.</p>
                @else
                    <table class="table table-striped" style="margin:0px 50px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CPF</th>
                                <th>IP</th>
                                <th>Horário</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sufragio->participantes->sortBy('id') as $participante)
                                <tr>
                                    <td>{{ $participante->id }}</td>
                                    <td>{{ $participante->cpf }}</td>
                                    <td>{{ $participante->ip }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($participante->votou_em)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </section>
        </div>

        <footer class="text-center mt-5">
            <p>© {{ now()->year }} - SINPROFAZ - Todos os direitos reservados.</p>
        </footer>
    </article>
</body>

</html>
