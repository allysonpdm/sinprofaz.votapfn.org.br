@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Votação </div>

                <div class="card-body">
                    <table id="list-respostas" class="table table-sm table-bordered table-striped table-hover text-nowrap">
                    </table>

                    <div id="group-respostas" class="col mt-5">
                        <h2>Respostas</h2>
                        <input id="sufragioId" type="hidden" value="{{ $votacao->id ?? null }}"/>
                        <input id="questaoId" type="hidden" value="{{ $questao->id ?? null }}"/>
                        <input id="respostaId" type="hidden" value="{{ $resposta->id ?? null }}"/>

                        <div class="col">
                            <label for="label">Label</label>
                            <input required id="label" class="form-control" placeholder="Label" type="text" value = "{{ $resposta->label ?? null }}"/>
                            <span data-erro="label" class="small text-danger"></span>
                        </div>

                        <div class="row mt-3">
                            @if (!empty($resposta->id))
                            <div class="col-3">
                                <button id="excluir-resposta" type="submit" class="btn btn-danger form-control">
                                    <span id="spinner-excluir" class="spinner-border spinner-border-sm"style="display:none;"></span>
                                    Excluir
                                </button>
                            </div>
                            @endif
                            <div class="col"></div>
                            <div class="col-3">
                                <a href="{{ route('admin.questao', ['id' => $questao->id, 'sufragioId'=>$votacao->id]) }}">
                                    <li class="btn btn-secondary form-control">
                                        Questões
                                    </li>
                                </a>
                            </div>
                            <div class="col-3">
                                <button id="salvar-resposta" type="submit" class="btn btn-success form-control">
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
