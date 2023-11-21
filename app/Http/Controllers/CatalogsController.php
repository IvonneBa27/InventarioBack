<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogCivilstatuses;
use App\Models\typeBlood;
use App\Models\relationship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Puesto;

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
        




}
