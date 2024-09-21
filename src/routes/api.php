<?php

use App\Http\Controllers\Api\{
    ArquivosController,
    AssociadosController,
    QuestoesController,
    RespostasController,
    SufragiosController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckJsonResultsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('associados', [AssociadosController::class, 'isAutorizado']);
Route::name('sufragios.')->prefix('sufragios/')->group(function () {
    Route::post('votar', [SufragiosController::class, 'votar']);
    Route::get('relatorio/{sufragioId}', [SufragiosController::class, 'relatorio']);
    Route::get('download/relatorio/{sufragioId}', [SufragiosController::class, 'relatorioDownload']);
});
Route::get('sufragios/em-andamento', [SufragiosController::class, 'emAndamento']);
Route::get('sufragios/encerradas', [SufragiosController::class, 'encerradas']);
Route::apiResource('sufragios', SufragiosController::class);
Route::apiResource('respostas', RespostasController::class);
Route::apiResource('questoes', QuestoesController::class);
Route::apiResource('arquivos', ArquivosController::class);

Route::get('health', HealthCheckJsonResultsController::class);
