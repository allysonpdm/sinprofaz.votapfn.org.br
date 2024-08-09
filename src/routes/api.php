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
});
Route::apiResource('sufragios', SufragiosController::class);
Route::apiResource('respostas', RespostasController::class);
Route::apiResource('questoes', QuestoesController::class);
Route::apiResource('arquivos', ArquivosController::class);
