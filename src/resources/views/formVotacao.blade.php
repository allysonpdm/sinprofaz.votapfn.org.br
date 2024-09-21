@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header icon-votacao">
                        <h2><i class="fas fa-vote-yea"></i> Configurando a votação</h2>
                    </div>

                    <div class="card-body">
                        <input id="sufragioId" type="hidden" value="{{ $votacao->id ?? null }}" />

                        <div class="mb-4">
                            <label for="nome" class="form-label">Nome</label>
                            <input required id="nome" class="form-control" placeholder="Título da Votação"
                                type="text" value="{{ $votacao->nome ?? null }}" />
                            <span data-erro="nome" class="small text-danger"></span>
                        </div>

                        <div class="mb-4">
                            <label for="subtitulo" class="form-label">Subtítulo</label>
                            <input required id="subtitulo" class="form-control" placeholder="Subtítulo da Votação"
                                type="text" value="{{ $votacao->subtitulo ?? null }}" />
                            <span data-erro="subtitulo" class="small text-danger"></span>
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea required id="descricao" class="form-control" placeholder="Descrição detalhada da votação" rows="3">{{ $votacao->descricao ?? null }}</textarea>
                            <span data-erro="descricao" class="small text-danger"></span>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="inicio" class="form-label">Início</label>
                                <input required id="inicio" class="form-control" type="datetime-local"
                                    value="{{ $votacao->inicio ?? null }}" />
                                <span data-erro="inicio" class="small text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="fim" class="form-label">Fim</label>
                                <input required id="fim" class="form-control" type="datetime-local"
                                    value="{{ $votacao->fim ?? null }}" />
                                <span data-erro="fim" class="small text-danger"></span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5><i class="fas fa-restriction-sign" style="color: orange"></i> Restrições</h5>
                            <p class="text-muted small">Esta etapa é opcional.</p>
                            <div class="col-md-6">
                                <label for="restricao_uf" class="form-label">UF de Lotação</label>
                                <select id="restricao_uf" name="restricoes[uf_lotacao][]" class="form-control" multiple>
                                    <option value="">Selecione</option>
                                    @foreach ($ufs as $uf)
                                        <option value="{{ $uf->uf }}">{{ $uf->nome }}</option>
                                    @endforeach
                                </select>
                                <span data-erro="restricoes" class="small text-danger"></span>
                                <small class="text-muted">Segure Ctrl (ou Cmd no Mac) para selecionar múltiplas opções.</small>
                            </div>
                        </div>


                        <div class="row mt-3 justify-content-end p-3">
                            <div class="col-md-auto d-inline-flex">
                                @if (!empty($votacao->id))
                                    <button id="excluir-votacao" type="submit" class="btn btn-danger me-2">
                                        <span id="spinner-excluir" class="spinner-border spinner-border-sm" style="display:none;"></span>
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                @endif
                                <button id="salvar-votacao" type="submit" class="btn btn-success">
                                    <span id="spinner-salvar" class="spinner-border spinner-border-sm" style="display:none;"></span>
                                    <i class="fas fa-save"></i> Salvar e continuar
                                </button>
                            </div>
                        </div>

                        <div class="card-footer text-center">
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
