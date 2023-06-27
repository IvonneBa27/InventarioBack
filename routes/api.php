<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlackListController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CatPermisoController;
use App\Http\Controllers\ProductoController;
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
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\warehouse_income_typeController;
use App\Http\Controllers\warehouse_entryController;
use App\Http\Controllers\warehouse_entry_detailController;
use App\Http\Controllers\product_detail_warehouse_entryController;
use App\Http\Controllers\transferStoreController;
use App\Http\Controllers\transferStoreDetailController;
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
Route::get('/usuario/getPermissionModules', [UsuarioController::class, 'getPermissionModules']);

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
Route::get('/Banco/get', [GeneralController::class, 'getBanco']); //Catalogo Banco - Modulo User
Route::get('/Estatus/get', [GeneralController::class, 'getEstatus']);
Route::get('/Departamento/get', [GeneralController::class, 'getDepartamento']);
Route::get('/Turno/get', [GeneralController::class, 'getTurno']);
Route::get('/TipoModulo/get', [GeneralController::class, 'getTipoModulo']);
Route::get('/searchUsers/get',[GeneralController::class, 'searchUsers']);
Route::get('/User/get',[GeneralController::class, 'getUsuario']);
Route::get('/getMaritalStatus',[GeneralController::class, 'getMaritalStatus']);
Route::get('/getTypeBloods',[GeneralController::class, 'typeBloods']);
Route::get('/getRelationship',[GeneralController::class, 'relationship']);

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

Route::get( '/getCauses', [GeneralController::class, 'getCauses']);
Route::get('/gerReasons', [GeneralController::class, 'gerReasons']);

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
Route::get('/suppliers/getListSuplier', [SuppliersController::class, 'getListSuplier']);
Route::get('/suppliers/id', [SuppliersController::class, 'getById']);
Route::post('/suppliers/update', [SuppliersController::class, 'update']);
Route::post('/suppliers/delete', [SuppliersController::class, 'delete']);


//Categoria
Route::post('categories/create',[Cat_categoriesController::class, 'create']);
Route::get('categories/get',[Cat_categoriesController::class, 'get']);
Route::get('categories/getList',[Cat_categoriesController::class, 'get_List_Categorie']);//Stored para Lista de Categoria
Route::get('categories/id', [Cat_categoriesController::class, 'getById']);
Route::get('categories/catid', [Cat_categoriesController::class, 'getByIdCat']);
Route::post('categories/update',[Cat_categoriesController::class, 'update']);
Route::post('categories/delete',[Cat_categoriesController::class, 'delete']);

//SubCategoria
Route::post('subcategories/create',[Cat_subcategoriesController::class, 'create']);
Route::get('subcategories/get',[Cat_subcategoriesController::class, 'get']);
Route::get('subcategories/getList',[Cat_subcategoriesController::class, 'get_List_Subcategorie']);//Stored para Lista de SubCategoria
Route::get('subcategories/id', [Cat_subcategoriesController::class, 'getById']);
Route::get('subcategories/subcatid', [Cat_subcategoriesController::class, 'getByIdCatSub']);
Route::get('subcategories/catalogSubcat', [Cat_subcategoriesController::class, 'getCatalog_Subcategorie']);// Funcion para detalle de Ingreso Almacen
Route::get('subcategories/subid', [Cat_subcategoriesController::class, 'getByIdSubCat']);
Route::post('subcategories/update',[Cat_subcategoriesController::class, 'update']);
Route::post('subcategories/delete',[Cat_subcategoriesController::class, 'delete']);


//Producto
Route::post('products/create',[ProducsController::class, 'create']);
Route::get('products/get',[ProducsController::class, 'get']);
Route::get('products/getCatalog_productCategorie',[ProducsController::class, 'getCatalog_productCategorie']); //Modulo de Ingreso de Almacen obtener producto
Route::get('products/getListProduct_Categorie',[ProducsController::class, 'getListProduct_Categorie']); //Lista de Producto Categoria
//Route::get('products/getCat',[ProducsController::class, 'get']);
Route::get('products/id', [ProducsController::class, 'getById']);
Route::post('products/update',[ProducsController::class, 'update']);
Route::post('products/delete',[ProducsController::class, 'delete']);
Route::get('products/getCategory', [ProducsController::class, 'getCategory']);


// Almacenes
Route::post('stores/create',[StoresController::class, 'create']);
Route::get('stores/get',[StoresController::class, 'get']);
Route::get('stores/getAnt',[StoresController::class, 'getAnt']);
Route::get('stores/getListStoreSecction',[StoresController::class, 'getListStoreSecction']);
Route::get('stores/id', [StoresController::class, 'getById']);
Route::post('stores/update',[StoresController::class, 'update']);
Route::post('stores/delete',[StoresController::class, 'delete']);

//Seccion
Route::post('secctions/create',[SecctionsController::class, 'create']);
Route::get('secctions/get',[SecctionsController::class, 'get']);
Route::get('secctions/getList',[SecctionsController::class, 'get_List_Secction']);//Stored para Lista de Secctions
Route::get('secctions/getV1',[SecctionsController::class, 'getV1']);
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

//Warehouse Type Entry
Route::get('incomeTypeStores/get',[warehouse_income_typeController::class, 'get']);

//Warehouse Entry
Route::post('incomeStores/create',[warehouse_entryController::class, 'create']);
Route::get('incomeStores/get',[warehouse_entryController::class, 'get']);
Route::get('incomeStores/getListIncomeStore',[warehouse_entryController::class, 'getListIncomeStore']); // Stored para Lista de Ingresos al Almacen
Route::get('incomeStores/id', [warehouse_entryController::class, 'getById']);
Route::post('incomeStores/update', [warehouse_entryController::class, 'update']);

//warehouse Entry Detail
Route::post('incomeStoresDetail/create',[warehouse_entry_detailController::class, 'create']);
Route::get('incomeStoresDetail/get',[warehouse_entry_detailController::class, 'get']);
Route::get('incomeStoresDetail/id', [warehouse_entry_detailController::class, 'getById']);

//Product Detail Warehouse
Route::post('incomeStoresDetailProduct/create',[product_detail_warehouse_entryController::class, 'create']);
Route::get('incomeStoresDetailProduct/get',[product_detail_warehouse_entryController::class, 'get']);
Route::get('incomeStoresDetailProduct/id', [product_detail_warehouse_entryController::class, 'getById']);
Route::get('incomeStoresDetailProduct/getListIncomeProduct', [product_detail_warehouse_entryController::class, 'getListIncomeProduct']);
Route::post('incomeStoresDetailProduct/update',[product_detail_warehouse_entryController::class, 'update']);



// TODO : EMPLOYEES ROUTES
Route::get('employees/list', [EmployeesController::class, 'index']);
Route::get('employees/searchEmployees', [EmployeesController::class, 'searchEmployees']);
Route::post('employees/create', [EmployeesController::class, 'create']);
Route::post('employees/update', [EmployeesController::class, 'update']);
Route::get('employees/delete', [EmployeesController::class, 'destroy']);


//TransferDetailStore
Route::post('transferStore/create',[transferStoreController::class, 'create']);
Route::post('transferStore/update', [transferStoreController::class, 'update']);

//TransferStore
Route::post('transferDetailStore/create',[transferStoreDetailController::class, 'create']);


//  TODO: BLACKLIST ROUTES
Route::get('blacklist/list', [BlackListController::class, 'index']);
Route::post('blacklist/create', [BlackListController::class, 'create']);
Route::post('blacklist/update', [BlackListController::class, 'update']);
Route::get('blacklist/delete', [BlackListController::class, 'destroy']);

// TODO: RUTAS ENTRENADOR
// Route::get('/obtenerEntrenadores', [CoachController::class, 'index'])->middleware('auth:sanctum');
// Route::post('/crearEntrenador', [CoachController::class, 'store']);
// Route::post('/actualizarEntrenador', [CoachController::class, 'update']);