@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Votação </div>

                <div class="card-body">
                    <table id="list-questoes" class="table table-sm table-bordered table-striped table-hover text-nowrap">
                    </table>

                    <div id="group-questoes" class="col mt-5">
                        <h2>Questão</h2>
                        <input id="sufragioId" type="hidden" value="{{ $votacao->id ?? null }}"/>
                        <input id="questaoId" type="hidden" value="{{ $questao->id ?? null }}"/>

                        <div class="col">
                            <label for="label">Label</label>
                            <input required id="label" class="form-control" placeholder="Label" type="text" value = "{{ $questao->label ?? null }}"/>
                            <span data-erro="label" class="small text-danger"></span>
                        </div>

                        <div class="col">
                            <label for="complemento">Complemento</label>
                            <input required id="complemento" class="form-control" placeholder="Complemento" type="text" value = "{{ $questao->complemento ?? null }}"/>
                            <span data-erro="complemento" class="small text-danger"></span>
                        </div>

                        <div class="col">
                            <label for="limiteEscolhas">Limite de escolhas</label>
                            <input required id="limiteEscolhas" class="form-control" placeholder="Limite de escolhas" min="1" type="number" value = "{{ $questao->limiteEscolhas ?? null }}"/>
                            <span data-erro="limiteEscolhas" class="small text-danger"></span>
                        </div>

                        <div class="row mt-3">
                            @if (!empty($questao->id))
                            <div class="col-3">
                                <button id="excluir-questao" type="submit" class="btn btn-danger form-control">
                                    <span id="spinner-excluir" class="spinner-border spinner-border-sm"style="display:none;"></span>
                                    Excluir
                                </button>
                            </div>
                            @endif
                            <div class="col"></div>
                            <div class="col-3">
                                <a href="{{ route('admin.arquivos', ['sufragioId' => $votacao->id]) }}">
                                    <li class="btn btn-secondary form-control">
                                        Arquivos
                                    </li>
                                </a>
                            </div>
                            <div class="col-3">
                                <button id="salvar-questao" type="submit" class="btn btn-success form-control">
                                    <span id="spinner-salvar" class="spinner-border spinner-border-sm"style="display:none;"></span>
                                    Salvar
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
