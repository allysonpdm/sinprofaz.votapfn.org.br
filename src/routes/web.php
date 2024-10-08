<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect('https://sinprofaz.org.br/');
});

Route::get('/votacao/{id?}', function () {
    return view('associado');
});

Auth::routes([
    'register' => false,
]);

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/resultados', [App\Http\Controllers\HomeController::class, 'resultados'])->name('resultados');
    Route::get('/gerenciador', [App\Http\Controllers\HomeController::class, 'gerenciador'])->name('gerenciador');
    Route::get('/votacao/{id?}', [App\Http\Controllers\HomeController::class, 'votacao'])->name('votacao');
    Route::get('/votacao/{sufragioId?}/arquivos', [App\Http\Controllers\HomeController::class, 'arquivos'])->name('arquivos');
    Route::get('/votacao/{sufragioId}/questoes/{id?}', [App\Http\Controllers\HomeController::class, 'questoes'])->name('questao');
    Route::get('/votacao/{sufragioId}/questoes/{questaoId}/respostas/{id?}', [App\Http\Controllers\HomeController::class, 'respostas'])->name('resposta');
});

Route::get('health', HealthCheckResultsController::class);
Route::get('relatorio', [App\Http\Controllers\HomeController::class, 'relatorio']);
