<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogCivilstatuses;
use App\Models\typeBlood;
use App\Models\relationship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Puesto;
use App\Models\SubCategoria;
use App\Models\Departamento;
use App\Models\Turno;
use App\Models\Ubicaciones;

use App\Models\Paises;
use App\Models\Ciudades;
use App\Models\Delegaciones;


use App\Models\CatalogRecruitmentSources;




class CatalogsController extends Controller
{
    // civil status

    public function indexCivilStatus()
    {
        $civilStatus =DB::table('catalog_civil_statuses')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Estado Civil',
            'data' => $civilStatus
        ]);
    }

    public function createCivil(Request $request){
        $civilStatus = catalogCivilstatuses::create([
            'nombre'=>$request['nombre'],
            'id_estatus'=>$request['id_estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Estado Civil agregado',
             'data' => $civilStatus
         ]);
    }

    public function getIdCivil(Request $request){  
        $id = $request->get('id'); 
        $civilStatus = catalogCivilstatuses::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Estado Civil',
            'data' =>  $civilStatus
        ]);
    }

    public function updateCivil(Request $request){
        $civilStatus = catalogCivilstatuses::find($request['id']);  //Get parametro por metodo post    
        $civilStatus->nombre=$request['nombre'];
        $civilStatus->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Estado Civil actualizado',
            'data' => $civilStatus
        ]);
     }


      // relationships

    public function indexRelationships()
    {
        $relationships =DB::table('relationships')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Parentesco',
            'data' => $relationships
        ]);
    }

    public function createRelationships(Request $request){
        $relationships = relationship::create([
            'nombre'=>$request['nombre'],
            'id_estatus'=>$request['id_estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Parentesco agregado',
             'data' => $relationships
         ]);
    }

    public function getIdRelation(Request $request){  
        $id = $request->get('id'); 
        $relationships = relationship::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Parentesco',
            'data' =>  $relationships
        ]);
    }

    public function updateRelationships(Request $request){
        $relationships = relationship::find($request['id']);  //Get parametro por metodo post    
        $relationships->nombre=$request['nombre'];
        $relationships->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Parentesco actualizado',
            'data' => $relationships
        ]);
     }


      // typeblood

    public function indexTypeBlood()
    {
        $typeblood =DB::table('type_bloods')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de Sangre',
            'data' => $typeblood
        ]);
    }

    public function createTypeBlood(Request $request){
        $typeblood = typeBlood::create([
            'nombre'=>$request['nombre'],
            'id_estatus'=>$request['id_estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo de Sangre agregado',
             'data' => $typeblood
         ]);
    }

    public function getIdTypeBlood(Request $request){  
        $id = $request->get('id'); 
        $typeblood = typeBlood::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de Sangre',
            'data' =>  $typeblood
        ]);
    }

    public function updateTypeBlood(Request $request){
        $typeblood = typeBlood::find($request['id']);  //Get parametro por metodo post    
        $typeblood->nombre=$request['nombre'];
        $typeblood->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de Sangre actualizado',
            'data' => $typeblood
        ]);
     }


     // p o s i t i o n

    public function indexPosition()
    {
        $position =DB::table('catalog_company_position')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Puesto',
            'data' => $position
        ]);
    }

    public function createPosition(Request $request){
        $position = Puesto::create([
            'nombre'=>$request['nombre'],
            'estatus'=>$request['estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Puesto agregado',
             'data' => $position
         ]);
    }

    public function getIdPosition(Request $request){  
        $id = $request->get('id'); 
        $position = Puesto::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Puesto',
            'data' =>  $position
        ]);
    }

    public function updatePosition(Request $request){
        $position = Puesto::find($request['id']);  //Get parametro por metodo post    
        $position->nombre=$request['nombre'];
        $position->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Puesto actualizado',
            'data' => $position
        ]);
     }


          // a r e a 

    public function indexArea()
    {
        $area =DB::table('catalog_company_subcategories')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Area',
            'data' => $area
        ]);
    }

    public function createArea(Request $request){
        $area = SubCategoria::create([
            'nombre'=>$request['nombre'],
            'estatus'=>$request['estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Area agregado',
             'data' => $area
         ]);
    }

    public function getIdArea(Request $request){  
        $id = $request->get('id'); 
        $area = SubCategoria::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Area',
            'data' =>  $area
        ]);
    }

    public function updateArea(Request $request){
        $area = SubCategoria::find($request['id']);  //Get parametro por metodo post    
        $area->nombre=$request['nombre'];
        $area->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Area actualizado',
            'data' => $area
        ]);
     }


      // d e p a r t m e n t 

    public function indexDepartment()
    {
        $department =DB::table('company_department')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Departamento',
            'data' => $department
        ]);
    }

    public function createDepartment(Request $request){
        $department = Departamento::create([
            'nombre'=>$request['nombre'],
            'estatus'=>$request['estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Departamento agregado',
             'data' => $department
         ]);
    }

    public function getIdDepartment(Request $request){  
        $id = $request->get('id'); 
        $department = Departamento::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Departamento',
            'data' =>  $department
        ]);
    }

    public function updateDepartment(Request $request){
        $department = Departamento::find($request['id']);  //Get parametro por metodo post    
        $department->nombre=$request['nombre'];
        $department->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Departamento actualizado',
            'data' => $department
        ]);
     }


      // s h i f t 

    public function indexShift()
    {
        $shift =DB::table('type_schedule')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Turno',
            'data' =>$shift
        ]);
    }

    public function createShift(Request $request){
        $shift = Turno::create([
            'nombre'=>$request['nombre'],
            'estatus'=>$request['estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Turno agregado',
             'data' => $shift
         ]);
    }

    public function getIdShift(Request $request){  
        $id = $request->get('id'); 
        $shift = Turno::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Turno',
            'data' =>  $shift
        ]);
    }

    public function updateShift(Request $request){
        $shift = Turno::find($request['id']);  //Get parametro por metodo post    
        $shift->nombre=$request['nombre'];
        $shift->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Turno actualizado',
            'data' => $shift
        ]);
     }


       // s h i f t 

    public function indexLocation()
    {
        $location =DB::table('ubicaciones')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ubicación',
            'data' =>$location
        ]);
    }

    public function createLocation(Request $request){
        $location = Ubicaciones::create([
            'nombre'=>$request['nombre'],
            'estatus'=>$request['estatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Ubicacion agregado',
             'data' => $location
         ]);
    }

    public function getIdLocation(Request $request){  
        $id = $request->get('id'); 
        $location = Ubicaciones::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Ubicacion',
            'data' =>  $location
        ]);
    }

    public function updateLocation(Request $request){
        $location = Ubicaciones::find($request['id']);  //Get parametro por metodo post    
        $location->nombre=$request['nombre'];
        $location->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ubicacion actualizado',
            'data' => $location
        ]);
     }

     

         // civil status

    public function indexCountrie()
    {
        $countries =DB::table('countries')
                        ->select('*')
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Paises',
            'data' => $countries
        ]);
    }

    public function createCountrie(Request $request){
        $countries = Paises::create([
            'pais'=>$request['pais'],
            'clavesat'=>$request['clavesat'],
            'formato'=>$request['formato'],
            'activo'=>$request['activo'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Pais agregado',
             'data' => $countries
         ]);
    }

    public function getIdCountrie(Request $request){  
        $id = $request->get('idpais'); 
        $countries = DB::table('countries')->where('idpais', $id)->first();
       // $countries = Paises::find($idpais);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Pais',
            'data' =>  $countries
        ]);
    }

    public function updateCountrie(Request $request){
        $countries = Paises::find($request['idpais']);  //Get parametro por metodo post    
        $countries->pais=$request['pais'];
        $countries->clavesat=$request['clavesat'];
        $countries->formato=$request['formato'];
        $countries->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Pais actualizado',
            'data' => $countries
        ]);
     }

     public function searchCountrie(Request $request){
        $param = $request->get('param');

        $countries = Paises::where('pais', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Pais Localizado',
            'data' => $countries
        ]);
    }

    
    public function indexCitie(Request $request)
    {
        $id = $request->get('idpais'); 
        $cities =DB::table('cities')
                ->select('cities.idciudad', 'countries.idpais', 'countries.pais', 'cities.ciudad', 'cities.activo')
                ->join('countries','cities.idpais','=','countries.idpais')
                ->where('cities.idpais','=',$id)
                ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ciudades',
            'data' => $cities
        ]);
    }

    public function createCitie(Request $request){
        $cities = Ciudades::create([
            'idpais'=>$request['idpais'],
            'ciudad'=>$request['ciudad'],
            'activo'=>$request['activo'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Ciudad agregada',
             'data' => $cities
         ]);
    }

    public function getIdCitie(Request $request){  
        $id = $request->get('idciudad'); 
        $cities = DB::table('cities')->where('idciudad', $id)->first();
       // $countries = Paises::find($idpais);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Ciudad',
            'data' =>  $cities
        ]);
    }

    public function updateCitie(Request $request){
        $cities = Ciudades::find($request['idciudad']);  //Get parametro por metodo post    
        $cities->ciudad=$request['ciudad'];
        $cities->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ciudad actualizado',
            'data' => $cities
        ]);
     }

     public function searchCitie(Request $request){
        $param = $request->get('param');
        $idpais = $request ->get('idpais');

       // $cities = Ciudades::where('ciudad', 'like', '%'.$param.'%')->get();

       $cities  = DB::table('cities')
                ->select('cities.idciudad', 'countries.idpais', 'countries.pais', 'cities.ciudad', 'cities.activo')
                ->join('countries', 'cities.idpais', '=', 'countries.idpais')
                ->where(function ($query) use ($param) {
                    $query->where('cities.ciudad', 'like', '%' . $param . '%');
                })
                ->where('cities.idpais', '=', $idpais)
                ->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Ciudad Localizado',
            'data' => $cities
        ]);
    }

    public function indexTownship(Request $request)
    {
        $idpais = $request->get('idpais');
        $idciudad = $request ->get('idciudad');
        $towship= DB::table('township')
                        ->select('township.iddelegacion', 'township.idpais', 'countries.pais', 'township.idciudad', 'cities.ciudad', 'township.delegacion', 'township.activo')
                        ->join('cities','township.idciudad','=','cities.idciudad')
                        ->join('countries','countries.idpais','=','township.idpais')
                        ->where('township.idpais','=',$idpais)
                        ->where('township.idciudad','=',$idciudad)
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Delegaciones',
            'data' => $towship
        ]);
    }

    public function createTownship(Request $request){
        $towship = Delegaciones::create([
            'idpais'=>$request['idpais'],
            'idciudad'=>$request['idciudad'],
            'delegacion'=>$request['delegacion'],
            'activo'=>$request['activo'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Delegacion agregada',
             'data' => $towship
         ]);
    }

    public function getIdTownship(Request $request){  
        $id = $request->get('iddelegacion'); 
        $towship = DB::table('township')->where('iddelegacion', $id)->first();
       // $countries = Paises::find($idpais);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Delegacion',
            'data' =>  $towship
        ]);
    }

    public function updateTownship(Request $request){
        $towship = Delegaciones::find($request['iddelegacion']);  //Get parametro por metodo post    
        $towship->delegacion=$request['delegacion'];
        $towship->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Delgacion actualizado',
            'data' => $towship
        ]);
     }

     public function searchTownship(Request $request){
        $param = $request->get('param');
        $idpais = $request ->get('idpais');
        $idciudad = $request ->get('idciudad');


       // $cities = Ciudades::where('ciudad', 'like', '%'.$param.'%')->get();

       $towship = DB::table('township')
       ->select('township.iddelegacion', 'township.idpais', 'countries.pais', 'township.idciudad', 'cities.ciudad', 'township.delegacion', 'township.activo')
       ->join('cities', 'township.idciudad', '=', 'cities.idciudad')
       ->join('countries', 'countries.idpais', '=', 'township.idpais')
       ->where('township.idpais', '=', $idpais)
       ->where('township.idciudad', '=', $idciudad)
       ->where(function ($query) use ($param) {
           $query->where('township.delegacion', 'like', '%' . $param . '%');
       })
       ->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Ciudad Localizado',
            'data' => $towship
        ]);
    }

    
      // recruitment - sources

      public function indexRecruitmentSources()
      {
          $recruitmentSources =DB::table('catalog_recruitment_sources')
                          ->select('*')
                          ->get();
          return response()->json([
              'status' => 'success',
              'msg' => 'Industrias',
              'data' => $recruitmentSources
          ]);
      }
  
      public function createRecruitmentSources(Request $request){
        $recruitmentSources = CatalogRecruitmentSources::create([
              'name'=>$request['name'],
              'status'=>$request['status'],
          ]);
           return response()->json([
               'status' => 'success',
               'msg' => 'Industria agregada',
               'data' => $recruitmentSources
           ]);
      }
  
      public function getIdRecruitmentSources(Request $request){  
          $id = $request->get('id'); 
          $recruitmentSources = CatalogRecruitmentSources::find($id);
          
          return response()->json([
              'status' => 'success',
              'msg' => 'Industria',
              'data' =>  $recruitmentSources
          ]);
      }
  
      public function updateRecruitmentSources(Request $request){
        $recruitmentSources = CatalogRecruitmentSources::find($request['id']);  //Get parametro por metodo post    
        $recruitmentSources->name=$request['name'];
        $recruitmentSources->save();
          return response()->json([
              'status' => 'success',
              'msg' => 'Industria actualizada',
              'data' =>$recruitmentSources
          ]);
       }
  
        




}
