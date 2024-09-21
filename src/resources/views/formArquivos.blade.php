@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header icon-votacao">
                        <h2><i class="fas fa-paperclip"></i> Gerenciador de Anexos</h2>
                    </div>

                    <div class="card-body">
                        <h5 class="mb-3"><i class="fas fa-list-alt"></i> Arquivos anexados à votação</h5>
                        <div class="table-responsive"> <!-- Add this wrapper for responsive table -->
                            <table id="list-arquivos"
                                class="table table-sm table-bordered table-striped table-hover text-nowrap">
                                <!-- Cabeçalho e conteúdo da tabela aqui -->
                            </table>
                        </div>

                        <div id="group-arquivos" class="col mt-4">
                            <h5><i class="fas fa-file-upload"></i> Adicionar um Novo Arquivo</h5>
                            <p class="text-muted small">Esta etapa é opcional.</p>
                            <input id="sufragioId" type="hidden" value="{{ $votacao->id ?? null }}" />

                            <div class="mb-4">
                                <label for="label" class="form-label">Label</label>
                                <input required id="label" class="form-control" placeholder="Label" type="text" />
                                <span data-erro="label" class="small text-danger"></span>
                            </div>

                            <div class="mb-4">
                                <label for="file" class="form-label">Arquivo</label>
                                <input required id="file" class="form-control" placeholder="PDF" type="file" />
                                <span data-erro="file" class="small text-danger"></span>
                            </div>

                            <div class="row mt-3 justify-content-end p-3">
                                <div class="col-md-auto d-inline-flex">
                                    <button id="salvar-arquivo" type="submit" class="btn btn-primary me-2">
                                        <span id="spinner-salvar" class="spinner-border spinner-border-sm"
                                            style="display:none;"></span>
                                        <i class="fas fa-cloud-upload-alt"></i> Upload
                                    </button>
                                    <a href="{{ route('admin.questao', ['sufragioId' => $votacao->id]) }}"
                                        class="btn btn-success">
                                        <i class="fas fa-arrow-right"></i> Continuar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <div class="row col">
                            <div class="col-md-3">
                                <a href="{{ route('admin.votacao', ['id' => $votacao->id]) }}"
                                    class="btn btn-secondary form-control">
                                    <i class="fas fa-arrow-left"></i> Voltar
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
