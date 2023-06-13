<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cat_brands;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\catBrandPostRequest;
use Illuminate\Support\Facades\DB;

class catBrandController extends Controller
{
    //

    public function create(catBrandPostRequest $request){

        $catbrand = cat_brands::create([
            'name'=>$request['name'],
            'id_status'=>$request['id_status'],
            'id_subcategory'=>$request['id_subcategory'],
   
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Marca agregado',
             'data' => $catbrand
         ]);
     }

     public function get(Request $request){
        $id = $request->get('id_subcategory'); 
        $catbrand
        = DB::table('catalog_brands')
        ->join('status', 'catalog_brands.id_status','=', 'status.id')
        ->join('catalog_subcategories','catalog_brands.id_subcategory','=','catalog_subcategories.id')
        ->select('catalog_brands.id', 'catalog_brands.name as catname', 'catalog_subcategories.name', 'status.nombre')
        ->where('catalog_brands.id_subcategory', '=', $id)
        ->get();
         return response()->json([
             'status' => 'success',
             'msg' => 'Marca obtenidoss correctamente',
             'data' => $catbrand
         ]);
     }

     public function getById(Request $request){  
        $id = $request->get('id'); 
        $catbrand = cat_brands::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Marca obtenido por Id obtenido correctamente',
            'data' => $catbrand
        ]);
    }
 

     public function update(Request $request){
        $catbrand = cat_brands::find($request['id']);  //Get parametro por metodo post    
        $catbrand->name=$request['name'];
        $catbrand->id_subcategory=$request['id_subcategory'];
        $catbrand->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Marca actualizado',
            'data'   => $catbrand
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $catbrand = cat_brands::find($id);
        $catbrand->id_status=2;
        $catbrand->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Marca eliminado',
             'data' =>  $catbrand
         ]);
     }

}
