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
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\catModuloController;
use App\Http\Controllers\catTipoModuloController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\Cat_categoriesController;
use App\Http\Controllers\Cat_subcategoriesController;
use App\Http\Controllers\ProducsController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\SecctionsController;
use App\Http\Controllers\catBrandController;
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
Route::get('/usuario/getOrderBy', [UsuarioController::class, 'getOrderBy']);
Route::get('/usuario/id', [UsuarioController::class, 'getById']);
Route::post('/usuario/update', [UsuarioController::class, 'update']);
Route::post('/usuario/delete', [UsuarioController::class, 'delete']);
Route::get( '/usuario/getModules', [UsuarioController::class, 'getModuleUser']);
Route::get('/usuario/getModuleUserById', [UsuarioController::class, 'getModuleUserById']);
Route::post('/usuario/addPermisse', [UsuarioController::class, 'addPermisse']);
Route::get('/usuario/getStatus', [UsuarioController::class, 'getStatus']);

//Catalogos
Route::get('/TipoUsuario/get', [GeneralController::class, 'getTipoUsuario']);
Route::get('/Ubicaciones/get', [GeneralController::class, 'getUbicaciones']);
Route::get('/Empresa/get', [GeneralController::class, 'getEmpresa']);
Route::get('/Sexo/get', [GeneralController::class, 'getSexo']);
Route::get('/SubCategoria/get', [GeneralController::class, 'getSubCategoria']);
Route::get('/DomicilioUsuario/get', [GeneralController::class, 'getDomicilioUsuario']);
Route::get('/EjecucionAdministrativa/get', [GeneralController::class, 'getEjecucionAdministrativa']);
Route::get('/Compania/get', [GeneralController::class, 'getCompania']);
Route::get('/Puesto/get', [GeneralController::class, 'getPuesto']);
Route::get('/Banco/get', [GeneralController::class, 'getBanco']);
Route::get('/Estatus/get', [GeneralController::class, 'getEstatus']);
Route::get('/Departamento/get', [GeneralController::class, 'getDepartamento']);
Route::get('/Turno/get', [GeneralController::class, 'getTurno']);
Route::get('/TipoModulo/get', [GeneralController::class, 'getTipoModulo']);
Route::get('/searchUsers/get',[GeneralController::class, 'searchUsers']);
Route::get('/User/get',[GeneralController::class, 'getUsuario']);
//Catalogo Pais-Ciudad-Municipio
Route::get('/paises/get',[GeneralController::class, 'getIdPais']);
Route::get('/ciudadesT/get',[GeneralController::class, 'getIdCiudadT']);
Route::get('/ciudades/get',[GeneralController::class, 'getIdCiudad']);
Route::get('/delegaciones/get',[GeneralController::class, 'getIdDelegaciones']);
Route::get('/delegacionesT/get',[GeneralController::class, 'getIdDelegacionesT']);
//Catalogos SAIT
Route::get('/regimenfiscal/get',[GeneralController::class, 'getIdSatRegimenFiscal']);
Route::get('/regimencdfi/get',[GeneralController::class, 'getIdSatCFDI']);
//Buscador Cliente-Proveedor
Route::get('/searchClients/get',[GeneralController::class, 'searchClients']);
Route::get('/searchSuppliers/get',[GeneralController::class, 'searchSuppliers']);
//Marcas
Route::get('/brands/get',[GeneralController::class, 'getBrand']);
//Buscador Productos
Route::get('/searchProducts/get',[GeneralController::class, 'searchProducts']);
//Buscador Almacen
Route::get('/searchStores/get',[GeneralController::class, 'searchStores']);


//Modulo
Route::post('/modulo/create', [catModuloController::class, 'create']);
Route::get('/modulo/get', [catModuloController::class, 'get']);
Route::get('/modulo/id', [catModuloController::class, 'getById']);
Route::post('/modulo/update', [catModuloController::class, 'update']);
Route::post('/modulo/delete', [catModuloController::class, 'delete']);


//TipoModulo

Route::post('/tipomodulo/create', [catTipoModuloController::class, 'create']);
Route::get('/tipomodulo/get', [catTipoModuloController::class, 'get']);
Route::get('/tipomodulo/id', [catTipoModuloController::class, 'getById']);
Route::post('/tipomodulo/update', [catTipoModuloController::class, 'update']);
Route::post('/tipomodulo/delete', [catTipoModuloController::class, 'delete']);


//Logs

Route::post('/logs/create', [LogController::class, 'create']);
Route::get('/logs/get', [LogController::class, 'get']);



//Clientes
Route::post('/customers/create', [CustomersController::class, 'create']);
Route::get('/customers/get', [CustomersController::class, 'get']);
Route::get('/customers/id', [CustomersController::class, 'getById']);
Route::post('/customers/update', [CustomersController::class, 'update']);
Route::post('/customers/delete', [CustomersController::class, 'delete']);

//Proveedores
Route::post('/suppliers/create', [SuppliersController::class, 'create']);
Route::get('/suppliers/get', [SuppliersController::class, 'get']);
Route::get('/suppliers/id', [SuppliersController::class, 'getById']);
Route::post('/suppliers/update', [SuppliersController::class, 'update']);
Route::post('/suppliers/delete', [SuppliersController::class, 'delete']);


//Categoria
Route::post('categories/create',[Cat_categoriesController::class, 'create']);
Route::get('categories/get',[Cat_categoriesController::class, 'get']);
Route::get('categories/id', [Cat_categoriesController::class, 'getById']);
Route::get('categories/catid', [Cat_categoriesController::class, 'getByIdCat']);
Route::post('categories/update',[Cat_categoriesController::class, 'update']);
Route::post('categories/delete',[Cat_categoriesController::class, 'delete']);

//SubCategoria
Route::post('subcategories/create',[Cat_subcategoriesController::class, 'create']);
Route::get('subcategories/get',[Cat_subcategoriesController::class, 'get']);
Route::get('subcategories/id', [Cat_subcategoriesController::class, 'getById']);
Route::get('subcategories/catid', [Cat_subcategoriesController::class, 'getByIdCat']);
Route::get('subcategories/subid', [Cat_subcategoriesController::class, 'getByIdSubCat']);
Route::post('subcategories/update',[Cat_subcategoriesController::class, 'update']);
Route::post('subcategories/delete',[Cat_subcategoriesController::class, 'delete']);


//Producto
Route::post('products/create',[ProducsController::class, 'create']);
Route::get('products/get',[ProducsController::class, 'get']);
//Route::get('products/getCat',[ProducsController::class, 'get']);
Route::get('products/id', [ProducsController::class, 'getById']);
Route::post('products/update',[ProducsController::class, 'update']);
Route::post('products/delete',[ProducsController::class, 'delete']);
Route::get('products/getCategory', [ProducsController::class, 'getCategory']);


// Almacenes
Route::post('stores/create',[StoresController::class, 'create']);
Route::get('stores/get',[StoresController::class, 'get']);
Route::get('stores/id', [StoresController::class, 'getById']);
Route::post('stores/update',[StoresController::class, 'update']);
Route::post('stores/delete',[StoresController::class, 'delete']);

//Seccion
Route::post('secctions/create',[SecctionsController::class, 'create']);
Route::get('secctions/get',[SecctionsController::class, 'get']);
Route::get('secctions/id', [SecctionsController::class, 'getById']);
Route::get('secctions/stoid', [SecctionsController::class, 'getByIdStore']);
Route::post('secctions/update',[SecctionsController::class, 'update']);
Route::post('secctions/delete',[SecctionsController::class, 'delete']);

//brand
Route::post('brands/create',[catBrandController::class, 'create']);
Route::get('brands/get',[catBrandController::class, 'get']);
Route::get('brands/id', [catBrandController::class, 'getById']);
Route::post('brands/update',[catBrandController::class, 'update']);
Route::post('brands/delete',[catBrandController::class, 'delete']);





// TODO: RUTAS ENTRENADOR
// Route::get('/obtenerEntrenadores', [CoachController::class, 'index'])->middleware('auth:sanctum');
// Route::post('/crearEntrenador', [CoachController::class, 'store']);
// Route::post('/actualizarEntrenador', [CoachController::class, 'update']);