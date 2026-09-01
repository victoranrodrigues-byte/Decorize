<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MobiliaController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\MidiaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ItemModeloController;


Route::apiResource('users', UserController::class);
Route::apiResource('mobilias', MobiliaController::class);
Route::apiResource('projetos', ProjetoController::class);
Route::apiResource('ambientes', AmbienteController::class);
route::apiResource('midias', MidiaController::class);
route::apiResource('modelos', ModeloController::class);
route::apiResource('itens-modelos', ItemModeloController::class);
