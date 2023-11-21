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
        
        
        




}
