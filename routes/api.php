<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\TipoController;
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

Route::get('/get_usuario',[UsuarioController::class, 'get_usuario']);
Route::get('/get_usuarios', [UsuarioController::class, 'get_usuarios']);
Route::get('/get_perfil/{id}', [UsuarioController::class, 'get_perfil']);
Route::post('/actualizar_perfil/{id}', [UsuarioController::class, 'actualizar_perfil']);
Route::get('/eliminar_usuario/{id}', [UsuarioController::class, 'eliminar_usuario']);

Route::get('/get_vehiculos', [VehiculoController::class, 'get_vehiculos']);
Route::get('/get_vehiculo/{id}', [VehiculoController::class, 'get_vehiculo']);
Route::post('/add_vehiculo', [VehiculoController::class, 'add_vehiculo']);
Route::post('/editar_vehiculo/{id}',[VehiculoController::class, 'editar_vehiculo']);
Route::get('/eliminar_vehiculo/{id}', [VehiculoController::class, 'eliminar_vehiculo']);

Route::get('/get_tipos', [TipoController::class, 'get_tipos']);
Route::get('/estado_activo/{id}', [TipoController::class, 'estado_activo']);
Route::get('/estado_inactivo/{id}', [TipoController::class, 'estado_inactivo']);
Route::post('/add_tipo', [TipoController::class, 'add_tipo']);
Route::get('get_tipo/{id}', [TipoController::class, 'get_tipo']);
Route::post('/editar_tipo/{id}',[TipoController::class, 'editar_tipo']);
Route::get('/eliminar_tipo/{id}', [TipoController::class, 'eliminar_tipo']);
