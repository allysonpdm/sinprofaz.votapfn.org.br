@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Votação </div>

                <div class="card-body">
                    <table id="list-arquivos" class="table table-sm table-bordered table-striped table-hover text-nowrap">
                    </table>

                    <div id="group-arquivos" class="col mt-5">
                        <h2>Arquivo</h2>
                        <input id="sufragioId" type="hidden" value="{{ $votacao->id ?? null }}"/>

                        <div class="col">
                            <label for="label">Label</label>
                            <input required id="label" class="form-control" placeholder="Label" type="text" />
                            <span data-erro="label" class="small text-danger"></span>
                        </div>
                        <div class="col">
                            <label for="file">Arquivo</label>
                            <input required id="file" class="form-control" placeholder="PDF" type="file" />
                            <span data-erro="file" class="small text-danger"></span>
                        </div>

                        <div class="row mt-3">
                            <div class="col"></div>
                            <div class="col-3">
                                <a href="{{ route('votacao', ['id' => $votacao->id]) }}">
                                    <li class="btn btn-secondary form-control">
                                        Votação
                                    </li>
                                </a>
                            </div>
                            <div class="col-3">
                                <button id="salvar-arquivo" type="submit" class="btn btn-success form-control">
                                    <span id="spinner-salvar" class="spinner-border spinner-border-sm"style="display:none;"></span>
                                    Salvar
                                </button>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('questao', ['sufragioId' => $votacao->id]) }}">
                                    <li class="btn btn-primary form-control">
                                        Questões
                                    </li>
                                </a>
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
