<?php

namespace App\Http\Controllers;

use App\Models\producs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProducsPostRequest;
use Illuminate\Support\Facades\DB;

class ProducsController extends Controller
{
    public function create(ProducsPostRequest $request){

        $producs = Producs::create([
            'name'=>$request['name'],
            'id_categoty'=>$request['id_categoty'],
            'id_subcategory'=>$request['id_subcategory'],
            'sku'=>$request['sku'],
            'serial_number'=>$request['serial_number'],
            'id_brand'=>$request['id_brand'],
            'model'=>$request['model'],
            'description'=>$request['description'],
            'inventory'=>$request['inventory'],
            'photo'=>$request['photo'],
            'id_status'=>$request['id_status'],
            'id_unitmeasure'=>$request['id_unitmeasure'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Producto agregado',
             'data' => $producs
         ]);
     }


     /*public function get(){
        $producs = Producs::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Productos obtenidoss correctamente',
            'data' => $producs
        ]);
    }*/

    public function get(){
        //$producs = Producs::with('categories')->with('subcategories')->with('marca')->with('estatus')->get();
        
        $producs
        = DB::table('producs')
        ->select('producs.id', 'producs.name', 'cat_categories.name as namecat', 'cat_subcategories.name as namesubcat', 'cat_brands.name as namebrand', 'estatus.nombre as namestatus')
        ->join('cat_categories','producs.id_categoty','=','cat_categories.id')
        ->join('cat_subcategories','producs.id_subcategory','=','cat_subcategories.id')
        ->join('cat_brands','producs.id_brand','=','cat_brands.id')
        ->join('estatus','producs.id_status','=','estatus.id')
        ->orderBy('producs.id','asc')
        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Productos obtenidoss correctamente',
            'data' => $producs
        ]);
    }

    public function getById(Request $request){  
        $id = $request->get('id'); 
        $producs = Producs::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Producto obtenido por Id obtenido correctamente',
            'data' => $producs
        ]);
    }


    public function getCategory(Request $request){
        $param = $request->get('param');
        $producs = Producs::where('id_categoty','=',$param)->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Productos obtenidos correctamente',
            'data' => $producs
        
        ]);


    }

    public function update(Request $request){
        $producs = Producs::find($request['id']);  //Get parametro por metodo post    
        $producs->name=$request['name'];
        $producs->id_categoty=$request['id_categoty'];
        $producs->id_subcategory=$request['id_subcategory'];
        $producs->sku=$request['sku'];
        $producs->serial_number=$request['serial_number'];
        $producs->id_brand=$request['id_brand'];
        $producs->model=$request['model'];
        $producs->description=$request['description'];
        $producs->inventory=$request['inventory'];
        $producs->photo=$request['photo'];
        //$producs->id_status=$request['id_status'];
        $producs->id_unitmeasure=$request['id_unitmeasure'];
        $producs->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Producto actualizado',
            'data' => $producs
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $producs = Producs::find($id);
        $producs->id_status=2;
        $producs->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Producto eliminado',
             'data' => $producs
         ]);
     }
}
