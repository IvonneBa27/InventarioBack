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
use App\Http\Controllers\StoreExitController;
use App\Http\Controllers\StoreExitDetailsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportsInventoryController;
use App\Http\Controllers\DetailLogController;
use App\Http\Controllers\movementHistoryController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\AgeRangeController;
use App\Http\Controllers\AcademicLevelController;
use App\Http\Controllers\JobExperienceController;
use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\HistorialEmployeeStatusController;
use App\Http\Controllers\prospectEmployeeController;
use App\Http\Controllers\creditorsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CatalogSectionController;

use App\Http\Controllers\recruitmentSourcesController;
use App\Http\Controllers\FollowUpController;

use App\Http\Controllers\catalogPositionSalaryController;
use App\Http\Controllers\salaryAdjustmentController;

use App\Http\Controllers\vacationsController;
use App\Http\Controllers\usersVacationsController;
use App\Http\Controllers\usersVacationsDetailsController;



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
Route::get('/usuario/getUserExcel', [UsuarioController::class, 'getUserExcel']);
Route::get('/usuario/getUsersAuthorized', [UsuarioController::class, 'getUsersAuthorized']);
Route::get('/usuario/getUsersReceives', [UsuarioController::class, 'getUsersReceives']);
Route::get('/usuario/getSectionUserById', [UsuarioController::class, 'getSectionUserById']);
Route::get( '/usuario/getSections', [UsuarioController::class, 'getSectionUser']);
Route::get('/usuario/getPermissionSection', [UsuarioController::class, 'getPermissionSection']);
Route::post('/usuario/addPermisseSection', [UsuarioController::class, 'addPermisseSection']);
// G R A P H 
Route::get('usuario/graphStaff', [UsuarioController::class, 'getGraphStaff']);
Route::get('usuario/graphLocation', [UsuarioController::class, 'getGraphLocation']);
Route::get('usuario/graphCampaign', [UsuarioController::class, 'getGraphCampaing']);
Route::get('usuario/graphInternet', [UsuarioController::class, 'getGraphInternet']);
// E X C E L - P E R M I S S I O N S
Route::get('usuario/getDataUser', [UsuarioController::class, 'getDataUser']);

Route::get('usuario/GraphTala', [UsuarioController::class, 'getGraphCampaingTala']);
Route::get('usuario/GraphCox', [UsuarioController::class, 'getGraphCampaingCox']);
Route::get('usuario/GraphSurfmed', [UsuarioController::class, 'getGraphCampaingSurfmed']);
Route::get('usuario/GraphBancoppel', [UsuarioController::class, 'getGraphCampaingBancoppel']);
Route::get('usuario/GraphMontePiedad', [UsuarioController::class, 'getGraphCampaingMontePiedad']);
Route::get('usuario/GraphPeddle', [UsuarioController::class, 'getGraphCampaingPeddle']);
Route::get('usuario/GraphShriners', [UsuarioController::class, 'getGraphCampaingShriners']);

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
Route::get('StatusEmployees/get', [GeneralController::class, 'getStatusEmployees']);
Route::get('/getRecruitmentIndustries', [GeneralController::class, 'getRecruitmentIndustries']);
Route::get('/getCatalogRecruitmentSources', [GeneralController::class, 'getCatalogRecruitmentSources']);

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
Route::get('brandsCatalog/get',[GeneralController::class, 'getBrand']);
Route::get('brands/getBrandProd',[GeneralController::class, 'getbrandProduct']);
//Buscador Productos
Route::get('/searchProducts/get',[GeneralController::class, 'searchProducts']);
//Buscador Almacen
Route::get('/searchStores/get',[GeneralController::class, 'searchStores']);

Route::get( '/getCauses', [GeneralController::class, 'getCauses']);

Route::get( '/getCausesByReason', [GeneralController::class, 'getCausesByReason']);
Route::get('/gerReasons', [GeneralController::class, 'gerReasons']);
//Tipo de Salidas de Almacen
Route::get('typeExit/get', [GeneralController::class, 'getTypeExitStore']);
//Estatus de Inventario
Route::get('/InventoryStatus/get', [GeneralController::class, 'getInventoryStatus']);
Route::get('GroupsSysca/get', [GeneralController::class, 'getGroupSysca']);
Route::get('StructureUsers/get', [GeneralController::class, 'getStructureUser']);


//Modulo
Route::post('/modulo/create', [catModuloController::class, 'create']);
Route::get('/modulo/get', [catModuloController::class, 'get']);
Route::get('/modulo/id', [catModuloController::class, 'getById']);
Route::post('/modulo/update', [catModuloController::class, 'update']);
Route::post('/modulo/delete', [catModuloController::class, 'delete']);
Route::get('/modulo/getList',[catModuloController::class, 'get_ListCatModules']);//Stored para Lista de SubCategoria


//TipoModulo

Route::post('/tipomodulo/create', [catTipoModuloController::class, 'create']);
Route::get('/tipomodulo/get', [catTipoModuloController::class, 'get']);
Route::get('/tipomodulo/id', [catTipoModuloController::class, 'getById']);
Route::post('/tipomodulo/update', [catTipoModuloController::class, 'update']);
Route::post('/tipomodulo/delete', [catTipoModuloController::class, 'delete']);


//Logs

Route::post('/logs/create', [LogController::class, 'create']);
Route::get('/logs/get', [LogController::class, 'get']);


//DetailLog

Route::post('detailLog/create', [DetailLogController::class, 'create']);
Route::get('detailLog/get', [DetailLogController::class, 'get']);
Route::post('detailLog/update', [DetailLogController::class, 'update']);

//Clientes
Route::post('/customers/create', [CustomersController::class, 'create']);
Route::get('/customers/get', [CustomersController::class, 'get']);
Route::get('/customers/getListCustomers', [CustomersController::class, 'getListCustomers']);
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
Route::post('incomeStores/cancelled', [warehouse_entryController::class, 'updateCancelled']);
Route::get('incomeStores/ListIncome', [warehouse_entryController::class, 'getListIncome']);

//warehouse Entry Detail
Route::post('incomeStoresDetail/create',[warehouse_entry_detailController::class, 'create']);
Route::get('incomeStoresDetail/get',[warehouse_entry_detailController::class, 'get']);
Route::get('incomeStoresDetail/id', [warehouse_entry_detailController::class, 'getById']);
Route::post('incomeStoresDetail/updateAmount',[warehouse_entry_detailController::class, 'updateAmount']);

//Product Detail Warehouse
Route::post('incomeStoresDetailProduct/create',[product_detail_warehouse_entryController::class, 'create']);
Route::get('incomeStoresDetailProduct/get',[product_detail_warehouse_entryController::class, 'get']);
Route::get('incomeStoresDetailProduct/id', [product_detail_warehouse_entryController::class, 'getById']);
Route::get('incomeStoresDetailProduct/getListIncomeProduct', [product_detail_warehouse_entryController::class, 'getListIncomeProduct']);
Route::post('incomeStoresDetailProduct/update',[product_detail_warehouse_entryController::class, 'update']);
Route::post('incomeStoresDetailProduct/updateTransfer',[product_detail_warehouse_entryController::class, 'updateMovementTransfer']);
Route::post('incomeStoresDetailProduct/updateExit',[product_detail_warehouse_entryController::class, 'updateMovementExit']);


// TODO : EMPLOYEES ROUTES
Route::get('employees/list', [EmployeesController::class, 'index']);
Route::get('employees/searchEmployees', [EmployeesController::class, 'searchEmployees']);
Route::post('employees/create', [EmployeesController::class, 'create']);
Route::post('employees/update', [EmployeesController::class, 'update']);
Route::get('employees/delete', [EmployeesController::class, 'destroy']);
Route::get('employees/EmployeeId', [EmployeesController::class, 'IdEmployee']);
Route::get('employees/EmployeeProduct', [EmployeesController::class, 'EmployeeProduct']);

//TransferDetailStore
Route::post('transferStore/create',[transferStoreController::class, 'create']);
Route::post('transferStore/update', [transferStoreController::class, 'update']);
Route::post('transferStore/cancelled', [transferStoreController::class, 'updateCancelled']);
Route::get('transferStore/getListTransferStore',[transferStoreController::class, 'getListTransferStore']); // Stored para Lista de Traspasos al Almacen
Route::get('transferStore/getListTransfer',[transferStoreController::class, 'getListTransfer']); // Stored para Lista de Traspasos al Almacen
Route::post('transferStore/updateAmount',[transferStoreController::class, 'updateAmount']);

//TransferStore
Route::post('transferDetailStore/create',[transferStoreDetailController::class, 'create']);
Route::get('transferDetailStore/getListTransferProduct', [transferStoreDetailController::class, 'getListTransferProduct']);


//  TODO: BLACKLIST ROUTES
Route::get('blacklist/list', [BlackListController::class, 'index']);
Route::post('blacklist/create', [BlackListController::class, 'create']);
Route::post('blacklist/update', [BlackListController::class, 'update']);
Route::get('blacklist/delete', [BlackListController::class, 'destroy']);
Route::get('blacklist/search', [BlackListController::class, 'search']);

// TODO: RUTAS ENTRENADOR
// Route::get('/obtenerEntrenadores', [CoachController::class, 'index'])->middleware('auth:sanctum');
// Route::post('/crearEntrenador', [CoachController::class, 'store']);
// Route::post('/actualizarEntrenador', [CoachController::class, 'update']);



//Salida de Almacen  - StoresExit
Route::post('storeExit/create',[StoreExitController::class, 'create']);
Route::get('storeExit/getid', [StoreExitController::class, 'getById']);
Route::post('storeExit/update', [StoreExitController::class, 'update']);
Route::post('storeExit/cancelled', [StoreExitController::class, 'updateCancelled']);

//Detalle de Salida de Almacén - StoreExitDetail
Route::post('storeExitDetail/create',[StoreExitDetailsController::class, 'create']);

//Detalle de Salida de Almacén - StoreExitDetail
Route::post('historyKardex/createIncome',[movementHistoryController::class, 'create_Kardex_Income']);
Route::post('historyKardex/createTransfer',[movementHistoryController::class, 'create_Kardex_Transfer']);
Route::post('historyKardex/createExit',[movementHistoryController::class, 'create_Kardex_Exit']);
Route::get('historyKardex/get',[movementHistoryController::class, 'get']);
Route::get('historyKardex/searchKardexT',[movementHistoryController::class, 'searchKardexT']);

// TODO: UPDATE PASSWORD
Route::post('user/retiervePassword', [UsuarioController::class, 'retiervePassword']);


//Reporteria Inventario / Nivel Almacen
Route::get('reports/get', [ReportsInventoryController::class, 'getReportsInventoryAll']);
Route::get('reports/getInventariable', [ReportsInventoryController::class, 'getReportsInventory']);
//Reporteria Inventario / Nivel Categoria Detalle 
Route::get('reportsdetail/get', [ReportsInventoryController::class, 'getInventoryDetailAll']);
Route::get('reportsdetail/getDetail', [ReportsInventoryController::class, 'getInventoryDetail']);
//Reporteria Inventario / Producto
Route::get('reportsproducts/get', [ReportsInventoryController::class, 'getListProductDetail']);


// TODO: UPDATE IMG PROFILE
Route::post('user/updateImgProfile', [UsuarioController::class, 'updateImgProfile']);

Route::post('send-mail', [AuthController::class, 'sendEmail']);


//Api para obtener el tipo de dato 
Route::get('exchangeRate/getExchange', [ExchangeRateController::class, 'getExchangeRate']);
Route::get('exchangeRate/getAll', [ExchangeRateController::class, 'get']);
Route::get('exchangeRate/id', [ExchangeRateController::class, 'getId']);
Route::post('exchangeRate/update', [ExchangeRateController::class, 'update']);
Route::get('exchangeRate/searchExchange', [ExchangeRateController::class, 'searchExchange']);

//.:. V A C A N T E S 
Route::post('vacancies/create', [VacanciesController::class, 'create']);
Route::get('vacancies/get', [VacanciesController::class, 'getListVacancies']);
Route::post('vacancies/sendEmail', [VacanciesController::class, 'sendEmail']);


//.:. C A T A L O G S
//Catalogo Rango de Edad
Route::post('catalogAgeRange/create', [AgeRangeController::class, 'create']);
Route::get('catalogAgeRange/get', [AgeRangeController::class, 'getListAgeRange']);
Route::get('catalogAgeRange/id', [AgeRangeController::class, 'getById']);
Route::post('catalogAgeRange/update', [AgeRangeController::class, 'update']);
Route::post('catalogAgeRange/delete', [AgeRangeController::class, 'delete']);

//Catalogo Nivel de Estudios
Route::post('catalogAcademicLevel/create', [AcademicLevelController::class, 'create']);
Route::get('catalogAcademicLevel/get', [AcademicLevelController::class, 'getListAcademicLevel']);
Route::get('catalogAcademicLevel/id', [AcademicLevelController::class, 'getById']);
Route::post('catalogAcademicLevel/update', [AcademicLevelController::class, 'update']);
Route::post('catalogAcademicLevel/delete', [AcademicLevelController::class, 'delete']);

Route::post('catalogAcademicLevel/test', [TestController::class, 'createTest']);

//Catalogo Experiencia Laboral
Route::post('catalogJobExperience/create', [JobExperienceController::class, 'create']);
Route::get('catalogJobExperience/get', [JobExperienceController::class, 'getListJobExperience']);
Route::get('catalogJobExperience/id', [JobExperienceController::class, 'getById']);
Route::post('catalogJobExperience/update', [JobExperienceController::class, 'update']);
Route::post('catalogJobExperience/delete', [JobExperienceController::class, 'delete']);


// H I S T O R I C A L   S T A T U S   E M P L O Y E E S
Route::post('historicalStatus/create', [HistorialEmployeeStatusController::class, 'create']);
Route::post('historicalStatus/sendEmail', [HistorialEmployeeStatusController::class, 'sendEmail']);

// P R O S P E C T   E M P L O Y E E  
Route::post('prospectEmployee/receiveExcel', [prospectEmployeeController::class, 'receiveExcel']);
Route::get('prospectEmployee/getAll', [prospectEmployeeController::class, 'get']);
Route::get('prospectEmployee/dateRange', [prospectEmployeeController::class, 'dateRange']);
Route::get('prospectEmployee/catalogCampaing', [prospectEmployeeController::class, 'getCampaing']);
Route::get('prospectEmployee/searchName',[prospectEmployeeController::class, 'searchName']);
Route::get('prospectEmployee/searchCampaing',[prospectEmployeeController::class, 'searchCampaing']);


// C R E D I T O R S
Route::post('creditors/create', [creditorsController::class, 'create']);
Route::get('creditors/get', [creditorsController::class, 'get']);
Route::get('creditors/getListCreditors', [creditorsController::class, 'getListCreditors']);
Route::get('creditors/id', [creditorsController::class, 'getById']);
Route::post('creditors/update', [creditorsController::class, 'update']);
Route::post('creditors/delete', [creditorsController::class, 'delete']);
Route::get('creditors/search',[creditorsController::class, 'searchCreditors']);

//S E C T I O N
Route::post('subsection/create', [CatalogSectionController::class, 'create']);
Route::get('subsection/getList', [CatalogSectionController::class, 'get_ListSubsections']);//Stored para Lista de SubCategoria
Route::get('subsection/id', [CatalogSectionController::class, 'getById']);
Route::post('subsection/update', [CatalogSectionController::class, 'update']);



//  TODO : MODULO RECLUTAMUENTO
Route::post('recruitment', [ recruitmentSourcesController::class, 'create']);
Route::get('recruitment', [recruitmentSourcesController::class, 'index']);
Route::get('recruitment/filters', [recruitmentSourcesController::class, 'filterParams']);
Route::get('recruitment/filterDates', [recruitmentSourcesController::class, 'filterDates']);
Route::get('recruitment/delete', [recruitmentSourcesController::class, 'delete']);
Route::get('recruitment/getDetail', [recruitmentSourcesController::class, 'getDetail']);
Route::post('recruitment/update', [recruitmentSourcesController::class, 'update']);
Route::post('recruitment/cargar-cv', [recruitmentSourcesController::class, 'cargarPDF']);


//  TODO : MODULO SEGUIMIENTO
Route::post('followuup', [FollowUpController::class, 'create']);
Route::get('followuup', [FollowUpController::class, 'index']);




//C A T A L O G - S A L A R Y - P O S I T I O N 
Route::get('catalogSalary/index', [catalogPositionSalaryController::class, 'index']);
Route::get('catalogSalary/idSalary', [catalogPositionSalaryController::class, 'idSalaryPosition']);
Route::get('catalogSalary/id', [catalogPositionSalaryController::class, 'idSalary']);
Route::post('catalogSalary/create', [catalogPositionSalaryController::class, 'create']);
Route::post('catalogSalary/update', [catalogPositionSalaryController::class, 'update']);

// S A L A R Y - A D J U S T M E N T 
Route::post('salaryAdjustment/create', [salaryAdjustmentController::class, 'create']);
Route::post('salaryAdjustment/update', [salaryAdjustmentController::class, 'updateSalaryAdjustment']);
Route::get('salaryAdjustment/index', [salaryAdjustmentController::class, 'indexSalaryAdjustment']);




// V A C A T I O N S 
Route::get('vacation/index', [vacationsController::class, 'index']);
Route::get('vacation/vacationCalculation', [vacationsController::class, 'vacationCalculation']);


Route::get('usersVacations/index',[usersVacationsController::class, 'index']);
Route::post('usersVacations/create', [usersVacationsController::class, 'create']);
Route::post('usersVacations/update', [usersVacationsController::class, 'update']);
Route::post('usersVacationsDetails/create', [usersVacationsDetailsController::class, 'create']);

Route::get('usersVacations/id',[usersVacationsController::class, 'getById']);
Route::get('usersVacations/indexId',[usersVacationsController::class, 'indexId']);
Route::get('usersVacations/search',[usersVacationsController::class, 'searchUsersVacation']);


//  TODO : TRAKING
Route::post('traking', [recruitmentSourcesController::class, 'createTraking']);
Route::get('sections', [recruitmentSourcesController::class, 'getSection']);
