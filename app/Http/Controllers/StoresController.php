<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stores;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoresPostRequest;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    public function create(StoresPostRequest $request){

        $stores = Stores::create([
            'name'=>$request['name'],
            'url_maps'=>$request['url_maps'],
            'description'=>$request['description'],
            'id_status'=>$request['id_status'],
            'id_user'=>$request['id_user'],
            'essential_section'=>$request['essential_section'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Almacen agregado',
             'data' => $stores
         ]);
     }

     public function getAnt(){

         $stores =Stores::all();
 
            return response()->json([
             'status' => 'success',
             'msg' => 'Almacenes obtenidos correctamente',
             'data' => $stores
         ]);
 
 
     }
 
 


     public function get(){
       // $stores = Stores::with('secctions')->with('estatus')->with('users')->get();

      /* $stores
       = DB::table('stores')
       ->leftJoin('users','stores.id_user','=','users.id')
       ->leftJoin('estatus', 'stores.id_status','=', 'estatus.id')
       ->leftJoin('secctions','stores.id','=','secctions.id_store')
       ->select(DB::raw('count(*) as secctions_count, secctions.id_store'),'stores.id','stores.name','stores.url_maps','stores.description','stores.essential_section', 'users.nombre_completo', 'estatus.nombre')
       ->groupBy('stores.id', 'secctions.id_store', 'stores.name','stores.url_maps','stores.description','stores.essential_section', 'users.nombre_completo', 'estatus.nombre')
       ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Almacenes obtenidoss correctamente',
            'data' => $stores
        ]);*/

        $stores = DB::SELECT('CALL get_stores_secctions()');

           return response()->json([
            'status' => 'success',
            'msg' => 'Almacenes obtenidoss correctamente',
            'data' => $stores
        ]);


    }


    public function getListStoreSecction(){
        $stores = DB::SELECT('CALL get_list_store_secction()');
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de Almacenes/Seccion',
            'data' => $stores
        ]);
     }



    public function getById(Request $request){  
        $id = $request->get('id'); 
        $stores = Stores::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Almacen obtenido por Id obtenido correctamente',
            'data' => $stores
        ]);
    }

    public function getByIdStore(Request $request){  
        $id = $request->get('id'); 
        $stores = Stores::where('id_store', '=',$id)->get();
    
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Almacen obtenido por Id obtenido correctamente',
            'data' => $$stores
        ]);
    }


    public function update(Request $request){
        $stores = Stores::find($request['id']);  //Get parametro por metodo post    
        $stores->name=$request['name'];
        $stores->url_maps=$request['url_maps'];
        $stores->description=$request['description'];
        $stores->id_user=$request['id_user'];
        $stores->essential_section=$request['essential_section'];
        $stores->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Almacen actualizado',
            'data'   => $stores
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $stores = Stores::find($id);
        $stores->id_status=2;
        $stores->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Almacen eliminado',
             'data' => $stores
         ]);
     }
}
    