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
        = DB::table('products')
        ->select('products.id', 'products.name', 'catalog_categories.name as namecat', 'catalog_subcategories.name as namesubcat', 'catalog_brands.name as namebrand', 'status.nombre as namestatus')
        ->join('catalog_categories','products.id_categoty','=','catalog_categories.id')
        ->join('catalog_subcategories','products.id_subcategory','=','catalog_subcategories.id')
        ->join('catalog_brands','products.id_brand','=','catalog_brands.id')
        ->join('status','products.id_status','=','status.id')
        ->orderBy('products.id','asc')
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

    //Select por IdCategoria y IdSubCategoria para el modulo de Ingreso Detalle de Almacen

    public function getCatalog_productCategorie(Request $request){
        $id_category = $request->get('id_category');
        $id_subcategory = $request->get('id_subcategory');
        $producs 
        =DB::table('products')
        ->select('*')
        ->where('id_categoty','=',$id_category)
        ->where('id_subcategory','=',  $id_subcategory)
        ->get(); 

         
        return response()->json([
            'status' => 'success',
            'msg' => 'Productos obtenidos correctamente',
            'data' => $producs
        
        ]);
    }

    //Select por IdCategoria y IdSubCategoria para el modulo de Detalle de Almacen
    //Relacion con las tabla de relacion

    public function getListProduct_Categorie(Request $request){
        $id = $request->get('id');
        $id_category = $request->get('id_category');
        $id_subcategory = $request->get('id_subcategory');


        $producs 
        = DB::table('products')
        ->select('products.id', 'products.name', 'products.id_categoty', 'products.id_subcategory', 'products.sku', 'products.serial_number', 'products.id_brand', 'catalog_brands.name as namebrand', 'products.model')
        ->join('catalog_brands','products.id_brand','=','catalog_brands.id')
        ->where('products.id','=', $id)
        ->where('products.id_categoty','=',$id_category)
        ->where('products.id_subcategory','=',$id_subcategory)
        ->get();
         
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
