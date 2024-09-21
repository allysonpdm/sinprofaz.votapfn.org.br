@extends('layouts.gerenciador')

@section('content')
        <!-- Main Content -->
        <div class="container">
            <div id="principal" class="card p-4">
                <div class="icon-votacao">
                    <h2 class="card-title"><i class="fas fa-vote-yea"></i> {{ config('app.name') }}</h2>
                </div>

                <div class="mt-4">
                    <table id="votacoes" class="table table-striped table-hover">
                        <!-- Conteúdo da tabela -->
                    </table>
                </div>
            </div>
        </div>
@endsection
