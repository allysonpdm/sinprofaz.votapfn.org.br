<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lista de participantes</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        .pagenum:before {
            content: counter(page);
        }

        footer .pagenum:before {
            content: counter(page);
        }

        body {
            font-family: 'Nunito', sans-serif;
            font-size: 15px;
        }

        h1 {
            border-bottom: 1px solid #718096;
        }

        /*h2 {page-break-before: always;}*/
        ul, ol {
            list-style: none;
            text-align: justify;
            margin: 0;
            padding: 10px;
        }

        ol > li {
            background: #fff;
            margin: 0px;
            padding: 10px;
        }
        ol > li:nth-child(odd) { background: #f2f2f2; }

        .bordeado
        {
            border: 1px solid #000;
            border-radius: 10px;
            margin: 0px 0px 5px 0px;
        }

        li > ol > li {
            background: inherit;
            border-left: 5px solid #adadad;
            margin: 0px 10px;
            padding: 0px 20px;
        }
        li > ol > li:nth-child(odd) {
            background: inherit;
            border-left: 5px solid #d2d2d2;
        }

        .contato {
            border-left: 5px solid #fff;
            margin-left: 5px;
            padding-left: 5px;
        }

        .pagina {
            /*float:right;*/
        }
        .center {
                text-align: center;
            }m
        .center img {
            display: block;
        }
        footer {
            border-top: 1px solid #718096;
            position: fixed;
            width: 100%;
            bottom: 0;
            text-align: center;
            margin: auto;
            /*page-break-before: always;*/
        }
    </style>
</head>

<body class="antialiased">
    <article>
        <div class="center">
            <img src="{{ public_path('storage/images/logo.png') }}" width="150" height="75"/>
            <h1 class="mt-5">Sistema de Votação do SINPROFAZ</h1>
        </div>

        <div class="table-responsive mt-5">
            <h2>{{ $sufragio->nome }}</h2>
            <table class="table table-sm table-bordered">
                <tbody class="table-striped">
                    <tr>
                        <th scope="row" class="text-nowrap">ID</th>
                        <td>{{$sufragio->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-nowrap">Sub-titulo</th>
                        <td>{{$sufragio->subtitulo }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Descrição</th>
                        <td>{!! $sufragio->descricao !!}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-nowrap">Inicio</th>
                        <td>{{ date('d/m/Y H:i:s', strtotime($sufragio->inicio)) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-nowrap">Fim</th>
                        <td>{{ date('d/m/Y H:i:s', strtotime($sufragio->fim)) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-nowrap">Criada em</th>
                        <td>{{ date('d/m/Y H:i:s', strtotime($sufragio->createdAt)) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-nowrap">Modificada em</th>
                        <td>{{ date('d/m/Y H:i:s', strtotime($sufragio->updatedAt)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive mt-5" style="page-break-before:always;">
            <h2>Questionário</h2>
                <?php if($sufragio->questoes->isEmpty()): ?>
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr><th scope="row">Não houve questionário</th></tr>
                        </thead>
                    </table>
                <?php else: ?>
                    <?php foreach ($sufragio->questoes->sortBy('id') as $questao): ?>
                    <table class="table table-sm table-bordered">
                        <tbody class="thead-light mb-3">
                            <tr>
                                <th scope="row">Label</th>
                                <td>{{ $questao->label }}</td>
                            </tr>
                            <tr>
                                <th scope="row">ID</th>
                                <td>{{ $questao->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Complemento</th>
                                <td>{{ $questao->complemento }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Limite de escolhas</th>
                                <td>{{ $questao->limiteEscolhas }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Criado em</th>
                                <td>{{ date('d/m/Y H:i:s', strtotime($questao->createdAt)) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Modificado em</th>
                                <td>{{ date('d/m/Y H:i:s', strtotime($questao->updatedAt)) }}</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="{{$questao->respostas->count()}}">Alternativas disponíveis para escolha</th>
                            </tr>
                            <tr>
                                <td colspan="{{$questao->respostas->count()}}">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Label</th>
                                                <th>Votos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($questao->respostas as $resposta):?>
                                            <tr>
                                                <td>{{ $resposta->id }}</td>
                                                <td>{{ $resposta->label }}</td>
                                                <td>{{ $resposta->votos }}</td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="page-break-before:always;"></div>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>

        <div class="table-responsive mt-5">
            <h2>Participantes</h2>
            <table class="table table-bordered text-nowrap">
            <?php if($sufragio->participantes->isEmpty()): ?>
                <thead class="thead-light">
                    <tr><th>Não houve participantes</th></tr>
                </thead>
            <?php else: ?>
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>CPF</th>
                        <th>IP</th>
                        <th>Horário</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php foreach ($sufragio->participantes->sortBy('id') as $participante): ?>
                    <tr>
                        <td>{{ $participante->id }}</td>
                        <td>{{ $participante->cpf }}</td>
                        <td>{{ $participante->ip }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($participante->votouEm)) }}</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
            </table>
        </div>
    </article>
</body>
</html>
