@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Dashboard Header -->
            <div class="text-center mb-4">
                <h2 class="fw-bold">{{ __('Dashboard') }}</h2>
                <p class="text-muted">{{ __('Gerencie as votações e visualize os resultados.') }}</p>
            </div>

            <!-- Grid Layout for Actions -->
            <div class="row g-4">
                <!-- Gerenciar Votações -->
                <div class="col-md-6 d-flex">
                    <div class="p-4 border rounded-3 shadow-sm bg-white text-center w-100 d-flex flex-column">
                        <h5 class="mb-3">{{ __('Gerenciar Votações') }}</h5>
                        <p class="text-muted">{{ __('Crie, edite ou exclua votações facilmente.') }}</p>
                        <a href="{{ route('admin.gerenciador') }}" class="btn btn-secondary w-100 mt-auto d-flex align-items-center justify-content-center">
                            <i class="fas fa-tasks me-2"></i> {{ __('Acessar Gerenciador') }}
                        </a>
                    </div>
                </div>

                <!-- Resultados -->
                <div class="col-md-6 d-flex">
                    <div class="p-4 border rounded-3 shadow-sm bg-white text-center w-100 d-flex flex-column">
                        <h5 class="mb-3">{{ __('Resultados') }}</h5>
                        <p class="text-muted">{{ __('Visualize os resultados das votações em andamento ou finalizadas.') }}</p>
                        <a href="{{ route('admin.resultados') }}" class="btn btn-secondary w-100 mt-auto d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-line me-2"></i> {{ __('Ver Resultados') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
