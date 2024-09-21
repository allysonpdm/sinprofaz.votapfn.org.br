@extends('layouts.resultados')

@section('content')
    <div class="container">
        <div id="principal" class="card p-4">
            <div class="icon-votacao">
                <h2 class="card-title"><i class="fas fa-vote-yea"></i> {{ config('app.name') }}</h2>
            </div>

            <div class="mt-4">
                <div id="associados-box" class="mt-4">
                    <table id="votacoes" class="table table-striped table-hover">
                        <!-- Conteúdo da tabela -->
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-resultado" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Resultado</h4>
                </div>
                <div class="modal-body">
                    <h3 id="votacao-nome"></h3>
                    <div id="votacao" class="grid grid-cols-1 md:grid-cols-1" style="width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="voltar" type="button" class="btn btn-danger close" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
