<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogAgeRange;
use App\Http\Requests\AgeRangeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgeRangeController extends Controller
{
    
    //Crear datos en la tabla Age Range
    public function create(AgeRangeRequest $request){
       $ageRange = catalogAgeRange::create([
        'name_age_range'=>$request['name_age_range'],
        'id_status'=>$request['id_status'],
         ]);
        
         return response()->json([
            'status' => 'success',
            'msg' => 'Rango de edad agregado',
            'data' => $ageRange
             ]);
         }

    //Lista de Rangos de edades
    public function getListAgeRange(Request $request){    
            $ageRange =
            DB::table('catalog_age_range')
            ->select('catalog_age_range.id', 'catalog_age_range.name_age_range', 'catalog_age_range.id_status', 'status.nombre')
            ->join('status','catalog_age_range.id_status','=','status.id')
            ->get();
    
        return response()->json([
                'status' => 'success',
                'msg' => 'Rango de edades obtenidos',
                'data' => $ageRange
        ]);
    
    }
    //Obtener Rando de edad por ID
    public function getById(Request $request){  
        $id = $request->get('id'); 
        $ageRange = catalogAgeRange::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Rango de edad por Id',
            'data' =>  $ageRange
        ]);
    }

    //Actualizar tipo de Rango de edad
    public function update(Request $request){
        $ageRange = catalogAgeRange::find($request['id']);  //Get parametro por metodo post    
        $ageRange->name_age_range=$request['name_age_range'];
        $ageRange->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Rango de edad actualizada',
            'data'   => $ageRange
        ]);
     }

     //Eliminar tipo de Rango de edad
     public function delete(Request $request){
        $id = $request->get('id');
        $ageRange = catalogAgeRange::find($id);
        $ageRange->id_status=2;
        $ageRange->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Rango de edad eliminado',
             'data' => $ageRange
         ]);
     }
}
