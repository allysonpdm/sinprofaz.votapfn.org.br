@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header icon-votacao">
                    <h2><i class="fa-solid fa-square-check"></i> Configurando respostas</h2>
                </div>

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
                            <textarea required id="label" class="form-control" placeholder="Label" maxlength="180" rows="3">{{ $resposta->label ?? null }}</textarea>
                            <span data-erro="label" class="small text-danger"></span>
                        </div>

                        <div class="row mt-3 justify-content-end p-3">
                            <div class="col-md-auto d-inline-flex">
                                @if (!empty($votacao->id))
                                    <button id="excluir-resposta" type="submit" class="btn btn-danger me-2">
                                        <span id="spinner-excluir" class="spinner-border spinner-border-sm" style="display:none;"></span>
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                @endif
                                <button id="salvar-resposta" type="submit" class="btn btn-success">
                                    <span id="spinner-salvar" class="spinner-border spinner-border-sm" style="display:none;"></span>
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row card-footer">
                    <div class="col-3">
                        <a href="{{ route('admin.questao', ['id' => $questao->id, 'sufragioId'=>$votacao->id]) }}">
                            <li class="btn btn-secondary form-control">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </li>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.gerenciador') }}" class="btn btn-secondary form-control">
                            <i class="fa-solid fa-list"></i> Gerenciador
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
