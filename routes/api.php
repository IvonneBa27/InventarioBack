<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CatPermisoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\catTipoProductoController;
use App\Http\Controllers\catTipoMarcaController;
use App\Http\Controllers\UsuarioController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/datauser', [AuthController::class, 'dataUser'])->middleware('auth:sanctum');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/permisos', [CatPermisoController::class, 'get']);
Route::get('/permisos/id', [CatPermisoController::class, 'getById']);
Route::post('/permisos/create', [CatPermisoController::class, 'create']);
Route::delete('/permisos/delete', [CatPermisoController::class, 'delete']);
Route::post('/permisos/update', [CatPermisoController::class, 'update']);
Route::post('/producto/create', [ProductoController::class, 'create']);
Route::get('/producto', [ProductoController::class, 'get']);
Route::post('/producto/update', [ProductoController::class, 'update']);
Route::delete('/producto/delete', [ProductoController::class, 'delete']);
Route::post('/tipoproducto/create', [catTipoProductoController::class, 'create']);
Route::get('/tipoproducto/get', [catTipoProductoController::class, 'get']);
Route::post('/tipoproducto/update', [catTipoProductoController::class, 'update']);
Route::delete('/tipoproducto/delete', [catTipoProductoController::class, 'delete']);
Route::post('/tipomarca/create', [catTipoMarcaController::class, 'create']);
Route::get('/tipomarca/get', [catTipoMarcaController::class, 'get']);
Route::post('/tipomarca/update', [catTipoMarcaController::class, 'update']);
Route::delete('/tipomarca/delete', [catTipoMarcaController::class, 'delete']);
Route::post('/usuario/create', [UsuarioController::class, 'create']);
Route::get('/usuario/get', [UsuarioController::class, 'get']);
Route::get('/usuario/id', [UsuarioController::class, 'getById']);
Route::post('/usuario/update', [UsuarioController::class, 'update']);
Route::delete('/usuario/delete', [UsuarioController::class, 'delete']);
// TODO: RUTAS ENTRENADOR
// Route::get('/obtenerEntrenadores', [CoachController::class, 'index'])->middleware('auth:sanctum');
// Route::post('/crearEntrenador', [CoachController::class, 'store']);
// Route::post('/actualizarEntrenador', [CoachController::class, 'update']);