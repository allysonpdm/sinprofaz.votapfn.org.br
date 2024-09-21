@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header icon-votacao">
                        <h2><i class="fa-solid fa-question"></i> Gerenciador de perguntas</h2>
                    </div>

                    <div class="card-body">
                        <h5><i class="fa-solid fa-list"></i> Perguntas</h5>
                        <div class="table-responsive">
                            <table id="list-questoes"
                                class="table table-sm table-bordered table-striped table-hover text-nowrap">
                                <!-- Cabeçalho e conteúdo da tabela aqui -->
                            </table>
                        </div>

                        <div id="group-questoes" class="col mt-5">
                            <h4><i class="fas fa-pencil-alt"></i> Detalhes da Questão</h4>
                            <input id="sufragioId" type="hidden" value="{{ $votacao->id ?? null }}" />
                            <input id="questaoId" type="hidden" value="{{ $questao->id ?? null }}" />

                            <div class="mb-4">
                                <label for="label" class="form-label">Título</label>
                                <textarea required id="label" class="form-control" placeholder="Digite o título" maxlength="255" rows="2">{{ $questao->label ?? null }}</textarea>
                                <span data-erro="label" class="small text-danger"></span>
                            </div>

                            <div class="mb-4">
                                <label for="complemento" class="form-label">Descrição</label>
                                <textarea id="complemento" class="form-control" placeholder="Adicione uma descrição" maxlength="1000" rows="5">{{ $questao->complemento ?? null }}</textarea>
                                <span data-erro="complemento" class="small text-danger"></span>
                            </div>

                            <div class="col row">
                                <div class="mb-4 col-6">
                                    <label for="limiteEscolhas" class="form-label">Quantidade máxima de escolhas</label>
                                    <input required id="limiteEscolhas" class="form-control"
                                        placeholder="Número máximo de escolhas" min="1" type="number"
                                        value="{{ $questao->limiteEscolhas ?? null }}" />
                                    <span data-erro="limiteEscolhas" class="small text-danger"></span>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-end p-3">
                                <div class="col-md-auto d-inline-flex">
                                    @if (!empty($questao->id))
                                        <button id="excluir-questao" type="submit" class="btn btn-danger me-2">
                                            <span id="spinner-excluir" class="spinner-border spinner-border-sm"
                                                style="display:none;"></span>
                                            <i class="fas fa-trash-alt"></i> Excluir
                                        </button>
                                    @endif
                                    <button id="salvar-questao" type="submit" class="btn btn-success">
                                        <span id="spinner-salvar" class="spinner-border spinner-border-sm"
                                            style="display:none;"></span>
                                        <i class="fas fa-save"></i> Salvar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <div class="row col">
                            <div class="col-md-3">
                                <a href="{{ route('admin.arquivos', ['sufragioId' => $votacao->id]) }}">
                                    <button class="btn btn-secondary form-control">
                                        <i class="fas fa-arrow-left"></i> Voltar
                                    </button>
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
    </div>
@endsection
