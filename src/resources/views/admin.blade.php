@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <nav>
                        <ul class="nav nav-pills nav-justified btn-group btn-group-toggle btn-hover-style-1">
                            <a href="{{ route('admin.gerenciador') }}">
                                <li class="btn btn-primary" data-toggle="tab">
                                    Gerenciar votações
                                </li>
                            </a>
                            <a href="{{ route('admin.resultados') }}">
                                <li class="btn btn-primary" data-toggle="tab">
                                    Resultados
                                </li>
                            </a>
                        </ul>
                    </nav>
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
