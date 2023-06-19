<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\secctions;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SecctionsPostRequest;
use Illuminate\Support\Facades\DB;

class SecctionsController extends Controller
{
    public function create(SecctionsPostRequest $request){

        $secctions = Secctions::create([
            'name'=>$request['name'],
            'id_status'=>$request['id_status'],
            'id_store'=>$request['id_store'],
            'nomenclature'=>$request['nomenclature'],
            'image'=>$request['image'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Seccion agregado',
             'data' => $secctions
         ]);
     }

     public function getV1(Request $request){
        $secctions = Secctions::all();

        return response()->json([
            'status' => 'success',
            'msg' => 'Secciones obtenidoss correctamente',
            'data' => $secctions
        ]);
    }


     public function get(Request $request){
        //$secctions = Secctions::all();
        $id = $request->get('id'); 

        $secctions =
        DB::table('store_sections')
        ->select('store_sections.id', 'store_sections.name', 'store_sections.id_status', 'store_sections.nomenclature', 'store_sections.image', 'estatus.nombre')
        ->join('status','store_sections.id_status','=','status.id')
        ->where('store_sections.id_store','=',$id)
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Secciones obtenidoss correctamente',
            'data' => $secctions
        ]);

    }

    
    public function get_List_Secction(Request $request){  
        $id = $request->get('id_store'); 
        $secctions  = DB::SELECT('CALL get_list_secction(?)', [$id]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de Secciones',
            'data' =>  $secctions
        ]);   
    }

    public function getByIdStore(Request $request){  
        $id = $request->get('id'); 
        $secctions = Secctions::where('id_store', '=',$id)->get();
    
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Almacen por id  de Seccion obtenido correctamente',
            'data' => $secctions
        ]);
    }



    public function getById(Request $request){  
        $id = $request->get('id'); 
        $secctions = Secctions::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Seccion obtenido por Id obtenido correctamente',
            'data' => $secctions
        ]);
    }


    public function update(Request $request){
        $secctions = Secctions::find($request['id']);  //Get parametro por metodo post    
        $secctions->name=$request['name'];
        $secctions->id_store=$request['id_store'];
        $secctions->nomenclature=$request['nomenclature'];
        $secctions->image=$request['image'];
        $secctions->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Seccion actualizado',
            'data'   => $secctions
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $secctions = Secctions::find($id);
        $secctions->id_status=2;
        $secctions->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Seccion eliminado',
             'data' =>   $secctions
         ]);
     }
}