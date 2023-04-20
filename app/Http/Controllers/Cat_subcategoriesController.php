<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cat_subcategories;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Cat_subcategoriesPostRequest;
use Illuminate\Support\Facades\DB;

class Cat_subcategoriesController extends Controller
{
    public function create(Cat_subcategoriesPostRequest $request){
        
        $cat_subcategories = Cat_subcategories::create([
            'name'=>$request['name'],
            'id_category'=>$request['id_category'],
            'id_status'=>$request['id_status'],
            'sku_indispensable'=>$request['sku_indispensable'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'SubCategoria agregada',
             'data' => $cat_subcategories
         ]);
     }



    public function get(){
        $cat_subcategories = Cat_subcategories::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'SubCategorias obtenidas correctamente',
            'data' => $cat_subcategories
        ]);
    }

    public function getById(Request $request){  
        $id = $request->get('id'); 
        $cat_subcategories = Cat_subcategories::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'SubCategoria por id obtenido correctamente',
            'data' => $cat_subcategories
        ]);
    }

  
      public function update(Request $request){
        $cat_subcategories = Cat_subcategories::find($request['id']);  //Get parametro por metodo post    
        $cat_subcategories->name=$request['name'];
        $cat_subcategories->id_category=$request['id_category'];
        $cat_subcategories->sku_indispensable=$request['sku_indispensable'];
        $cat_subcategories->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'SubCategoria actualizada',
            'data' => $cat_subcategories
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $cat_subcategories = Cat_subcategories::find($id);
        $cat_subcategories->id_status=2;
        $cat_subcategories->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'SubCategoria eliminada',
             'data' => $cat_subcategories
         ]);
     }


}