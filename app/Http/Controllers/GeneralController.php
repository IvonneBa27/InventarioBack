<?php

namespace App\Http\Controllers;
use App\Models\TipoUsuario;
use App\Models\Ubicaciones;
use App\Models\Empresa;
use App\Models\Sexo;
use App\Models\SubCategoria;
use App\Models\DomicilioUsuario;
use App\Models\EjecucionAdministrativa ;
use App\Models\Compania;
use App\Models\Puesto;
use App\Models\Banco;
use App\Models\Estatus;
use App\Models\Departamento;
use App\Models\Turno;
use App\Models\TipoModulo;
use App\Models\Usuario;
use App\Models\Catalogo_sat_regimenfiscal;
use App\Models\Catalogo_sat_uso_cfdi;
use App\Models\Ciudades;
use App\Models\Delegaciones;
use App\Models\Paises;
use App\Models\Customers;
use App\Models\Suppliers;
use App\Models\cat_brands;
use App\Models\producs;
use App\Models\stores;
use App\Models\catalogCivilstatuses;
use App\Models\typeBlood;
use App\Models\relationship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\CatalogCauseBlackList;
use App\Models\CatalogReasonBlackList;
use App\Models\typeStoreExits;
use App\Models\inventory_status;
use App\Models\GroupsSysca;
use App\Models\RecruitmentIndustries;
use App\Models\CatalogRecruitmentSources;
uSE App\Models\catalogs;






use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //

    public function getTipoUsuario()
    {
       $tipoUsuario = TipoUsuario::where('id','!=',1)->where('id','!=',2)->get();
       return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de Usuario obtenido correctamente',
            'data' => $tipoUsuario
        ]);
    }

    public function getUbicaciones()
    {
        $ubicaciones = Ubicaciones::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ubicaciones obtenido correctamente',
            'data' => $ubicaciones
        ]);
    }

    public function getEmpresa()
    {
        $empresa = Empresa::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Empresa obtenido correctamente',
            'data' => $empresa
        ]);

    }
    public function getSexo()
    {
        $sexo = Sexo::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Sexo obtenido correctamente',
            'data' => $sexo
        ]);

    }
    public function getSubCategoria()
    {
        $subcategoria = SubCategoria::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'SubCategoria obtenido correctamente',
            'data' => $subcategoria
        ]);
    }


    public function getDomicilioUsuario()
    {
        $domiciliousuario = DomicilioUsuario::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Domicilio obtenido correctamente',
            'data' => $domiciliousuario
        ]);

    }
    public function getEjecucionAdministrativa()
    {
        $ejecucionadministrativa = EjecucionAdministrativa::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ejecucion Administrativa obtenido correctamente',
            'data' => $ejecucionadministrativa
        ]);

    }

    public function getCompania()
    {
        $compania = Compania::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Compania obtenido correctamente',
            'data' => $compania
        ]);

    }


    public function getPuesto()
    {
        $puesto = Puesto::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Puesto obtenido correctamente',
            'data' => $puesto
        ]);

    }

    //Catalogo de Bancos
    public function getBanco(){
        $banco = Banco::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Banco obtenido correctamente',
            'data' => $banco
        ]);
    }

    public function getEstatus()
    {
       // $estatus = Estatus::where('id','!=',2)->where('id','!=',3)->get();
        $estatus = Estatus::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Estatus obtenido correctamente',
            'data' => $estatus
        ]);

    }

    public function getStatusEmployees()
    {
         $status = DB::table('status')
                 ->select('id', 'nombre')
                 ->whereIn('id',[1, 2])
                 ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Estatus obtenido correctamente',
            'data' => $status
        ]);

    }
    
    public function getDepartamento()
    {
        $departamento = Departamento::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Departamento obtenido correctamente',
            'data' => $departamento
        ]);

    }
    public function getTurno()
    {
        $turno = Turno::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Turno obtenido correctamente',
            'data' => $turno
        ]);

    }

    public function getTipoModulo()
    {
        $tipomodulo = TipoModulo::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo modulo obtenido correctamente',
            'data' => $tipomodulo
        ]);

    }

    public function getGroupSysca()
    {
        $groupsSysca = GroupsSysca::orderBy('nombre', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Campañas obtenido correctamente',
            'data' => $groupsSysca
        ]);

    }

    public function searchUsers(Request $request){
        $param = $request->get('param');

        $users = Usuario::where('nombre_completo', 'like', '%'.$param.'%')->orwhere('numero_empleado', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Usuarios obtenidos correctamente',
            'data' => $users
        ]);
    }

    public function searchClients(Request $request){
        $param = $request->get('param');

        $customers = Customers::where('razon_social', 'like', '%'.$param.'%')->orwhere('no_cliente', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Clientes obtenidos correctamente',
            'data' => $customers
        ]);
    }

    public function searchSuppliers(Request $request){
        $param = $request->get('param');

        $suppliers = Suppliers::where('razon_social', 'like', '%'.$param.'%')->orwhere('id', 'like', '%'.$param.'%')->orwhere('observaciones', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Proveedores obtenidos correctamente',
            'data' => $suppliers
        ]);
    }


    public function getIdPais()
    {
        $pais = Paises::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Paises obtenidos correctamente',
            'data' => $pais
        ]);

    }

    public function getIdCiudadT(Request $request)
    {
        $ciudad = Ciudades::orderBy('ciudad','ASC')
                          ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ciudades obtenidos correctamente',
            'data' => $ciudad
        ]);

    }

    public function getIdCiudad(Request $request)
    {
        $param = $request->get('param');

        $ciudad = Ciudades::where('idpais','=', $param)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ciudades obtenidos correctamente',
            'data' => $ciudad
        ]);

    }

    public function getIdDelegaciones(Request $request)
    {
        $param = $request->get('param');
        $param1 = $request->get('param1');
        $delegacion = Delegaciones::where('idpais','=', $param)->where('idciudad','=', $param1)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Municipios obtenidos correctamente',
            'data' => $delegacion
        ]);

    }
    public function getIdDelegacionesT(Request $request)
    {
   
        $delegacion = Delegaciones::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Municipios obtenidos correctamente',
            'data' => $delegacion
        ]);

    }


    public function getIdSatRegimenFiscal()
    {
        $satregimenfiscal = Catalogo_sat_regimenfiscal::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'SAIT Regimen Fiscal obtenidos correctamente',
            'data' => $satregimenfiscal
        ]);

    }

    public function getIdSatCFDI()
    {
        $satcfdi = Catalogo_sat_uso_cfdi::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'SAIT CFDI obtenidos correctamente',
            'data' => $satcfdi
        ]);

    }

    public function getBrand()
    {
       // $brand = cat_brands::all();

      $brand    =  DB::table('catalog_brands')
                ->select('*')
                ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Marcas obtenidos correctamente',
            'data' => $brand
        ]);

    }





    public function getbrandProduct(Request $request)
    {
        $id_subcategory = $request->get('id_subcategory');
        $brand
        =DB::table('catalog_brands')
        ->select('*')
        ->where('id_subcategory','=',  $id_subcategory)
        ->get(); 

        return response()->json([
            'status' => 'success',
            'msg' => 'Marcas obtenidos correctamente',
            'data' => $brand
        ]);

    }


    public function searchProducts(Request $request){
        $param = $request->get('param');

        //$producs = Producs::where('name', 'like', '%'.$param.'%')->orwhere('id', 'like', '%'.$param.'%')->get();
        
        $producs
        = DB::table('producs')
        ->select('producs.id', 'producs.name', 'cat_categories.name as namecat', 'cat_subcategories.name as namesubcat', 'cat_brands.name as namebrand', 'estatus.nombre as namestatus')
        ->join('cat_categories','producs.id_categoty','=','cat_categories.id')
        ->join('cat_subcategories','producs.id_subcategory','=','cat_subcategories.id')
        ->join('cat_brands','producs.id_brand','=','cat_brands.id')
        ->join('estatus','producs.id_status','=','estatus.id')
        ->where('producs.name', 'like', '%'.$param.'%')
        ->orwhere('producs.id', 'like', '%'.$param.'%')
        ->orderBy('producs.id','asc')
        ->get();
        
        
        return response()->json([
            'status' => 'success',
            'message' => 'Productos obtenidos correctamente',
            'data' => $producs
        ]);


    }

    public function searchStores(Request $request){
        $param = $request->get('param');

        $stores
        = DB::table('stores')
        ->join('users','stores.id_user','=','users.id')
        ->join('status', 'stores.id_status','=', 'status.id')
        ->join('store_sections','stores.id','=','store_sections.id_store')
        ->select(DB::raw('count(*) as secctions_count, store_sections.id_store'),'stores.id','stores.name','stores.url_maps','stores.description','stores.essential_section', 'users.nombre_completo', 'status.nombre')
        ->where('stores.name', 'like', '%'.$param.'%')
        ->orwhere('users.nombre_completo', 'like', '%'.$param.'%')
        ->groupBy('stores.id', 'store_sections.id_store', 'stores.name','stores.url_maps','stores.description','stores.essential_section', 'users.nombre_completo', 'status.nombre')
        ->get();

        //$stores = Stores::where('name', 'like', '%'.$param.'%')->orwhere('id_user', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Almacenes obtenidos correctamente',
            'data' => $stores
        ]);


    }


    public function getUsuario()
    {
       //$tipoUsuario = TipoUsuario::where('id','!=',1)->where('id','!=',2)->get();
       $user = Usuario::all();
       return response()->json([
            'status' => 'success',
            'msg' => 'Usuario obtenido correctamente',
            'data' => $user
        ]);
    }


    public function getMaritalStatus(){
        $civilstatuses = catalogCivilstatuses::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Estados civil obtenidos correctamente',
            'data' => $civilstatuses
        ]);
    }

    // tipo de sangre
    public function typeBloods() {
        $typeBloods = typeBlood::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipos de sangre obtenidos correctamente',
            'data' => $typeBloods
        ]);
    }

    // parentesco
    public function relationship() {
        
        $relationship = relationship::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Parentescos obtenidos correctamente',
            'data' => $relationship
        ]);
    }

    // parentesco
    public function getCauses()
    {

        $causes = CatalogCauseBlackList::all();
        return response()->json([
                'status' => 'success',
                'msg' => 'Causas obtenidas correctamente',
                'data' => $causes
            ]);
    }


    public function getCausesByReason(Request $request)
    {
        $id_parent = $request->get('id_parent');
        $causes =
                DB::table('catalog_cause_black_lists')
                ->select('*')
                ->where('id_parent','=',$id_parent)
                ->get();

                return response()->json([
                    'status' => 'success',
                    'msg' => 'Causas obtenidas correctamente',
                    'data' => $causes
                ]);
    }

    // parentesco
    public function gerReasons()
    {

        $reseasons = CatalogReasonBlackList::all();
        return response()->json([
                'status' => 'success',
                'msg' => 'Razones obtenidas correctamente',
                'data' => $reseasons
            ]);
    }

     // Tipos de Salidas de Almacen
     public function getTypeExitStore()
     {
         $typeExit = typeStoreExits::all();
         return response()->json([
                 'status' => 'success',
                 'msg' => 'Razones obtenidas correctamente',
                 'data' =>  $typeExit
             ]);
     }

     public function getInventoryStatus()
     {
        // $estatus = Estatus::where('id','!=',2)->where('id','!=',3)->get();
         $inventoryStatus = inventory_status::all();
         return response()->json([
             'status' => 'success',
             'msg' => 'Estatus de Inventario, Obtenidos correctamente',
             'data' => $inventoryStatus
         ]);
 
     }

     public function getStructureUser(Request $request){
        $id = $request->get('id');
         $structureUsers = DB::table('users')
                                    ->select('company_structure_type.nombre as structureType', 'company_department.nombre as department', 'catalog_company_position.nombre as position')
                                    ->join('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                                    ->join('company_department','users.id_departamento_empresa','=','company_department.id')
                                    ->join('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                                    ->where('users.id','=',$id)
                                    ->get();
         return response()->json([
             'status' => 'success',
             'msg' => 'User obtenido',
             'data' => $structureUsers
         ]);
 
     }



    // parentesco
    public function getRecruitmentIndustries()
    {

        $causes = RecruitmentIndustries::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Causas obtenidas correctamente',
            'data' => $causes
        ]);
    }

 // parentesco
    public function getCatalogRecruitmentSources()
    {

        $causes = CatalogRecruitmentSources::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Causas obtenidas correctamente',
            'data' => $causes
        ]);
    }

     // parentesco
     public function indexCatalogs()
     {
 
         $catalogs = DB::table('catalogs')
                        ->select('*')
                        ->where('status','=',1)
                        ->get();
         return response()->json([
             'status' => 'success',
             'msg' => 'Lista de Catalogos',
             'data' => $catalogs
         ]);
     }

     //Get router
     public function getRouter(Request $request){
        $id = $request->get('id');
        $catalogs = DB::table('catalogs')
                        ->select('location')
                        ->where('id','=',$id)
                        ->get();
     
         return response()->json([
             'status' => 'success',
             'msg' => 'Router por Id',
             'data' => $catalogs
         ]);
    }
 





}
