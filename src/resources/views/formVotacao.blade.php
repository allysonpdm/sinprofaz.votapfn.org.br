@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Votação </div>

                <div class="card-body">

                    <div id="group-votacao" class="col">
                        <input id="sufragioId" type="hidden" value="{{ $votacao->id ?? null }}"/>

                        <div class="col">
                            <label for="nome">Nome</label>
                            <input required id="nome" class="form-control" placeholder="Título" type="text" value = "{{ $votacao->nome ?? null }}"/>
                            <span data-erro="nome" class="small text-danger"></span>
                        </div>

                        <div class="col">
                            <label for="subtitulo">Sub-título</label>
                            <input required id="subtitulo" class="form-control" placeholder="Sub título" type="text" value = "{{ $votacao->subtitulo ?? null }}"/>
                            <span data-erro="subtitulo" class="small text-danger"></span>
                        </div>

                        <div class="col">
                            <label for="descricao">Descrição</label>
                            <input required id="descricao" class="form-control" placeholder="Descrição" type="text" value = "{{ $votacao->descricao ?? null }}"/>
                            <span data-erro="descricao" class="small text-danger"></span>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inicio">Início</label>
                                <input required id="inicio" class="form-control" type="datetime-local" value = "{{ $votacao->inicio ?? null }}"/>
                                <span data-erro="inicio" class="small text-danger"></span>
                            </div>
                            <div class="col">
                                <label for="fim">Fim</label>
                                <input required id="fim" class="form-control" type="datetime-local" value = "{{ $votacao->fim ?? null }}"/>
                                <span data-erro="fim" class="small text-danger"></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            @if (!empty($votacao->id))
                            <div class="col-3">
                                <button id="excluir-votacao" type="submit" class="btn btn-danger form-control">
                                    <span id="spinner-excluir" class="spinner-border spinner-border-sm"style="display:none;"></span>
                                    Excluir
                                </button>
                            </div>
                            @endif
                            <div class="col"></div>
                            <div class="col-3">
                                <a href="{{ route('admin.gerenciador') }}">
                                    <li class="btn btn-secondary form-control">
                                        Voltar
                                    </li>
                                </a>
                            </div>
                            <div class="col-3">
                                <button id="salvar-votacao" type="submit" class="btn btn-success form-control">
                                    <span id="spinner-salvar" class="spinner-border spinner-border-sm"style="display:none;"></span>
                                    Anexos
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
