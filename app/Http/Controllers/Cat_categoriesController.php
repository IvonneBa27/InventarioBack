<?php

namespace App\Http\Controllers;
use App\Models\cat_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Cat_categoriesPostRequest;
use Illuminate\Support\Facades\DB;

class Cat_categoriesController extends Controller
{
    public function create(Cat_categoriesPostRequest $request){

        $cat_categories = Cat_categories::create([
            'name'=>$request['name'],
            'id_status'=>$request['id_status'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Categoria agregada',
             'data' => $cat_categories
         ]);
     }



    public function get(){
    $cat_categories = Cat_categories::with('subcategories')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Categorias obtenidas correctamente',
            'data' => $cat_categories
        ]);
    }

    public function getById(Request $request){  
        $id = $request->get('id'); 
        $cat_categories = Cat_categories::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Categoria por id obtenido correctamente',
            'data' => $cat_categories
        ]);
    }

  
      public function update(Request $request){
        $cat_categories = Cat_categories::find($request['id']);  //Get parametro por metodo post    
        $cat_categories->name=$request['name'];
        $cat_categories->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Categoria actualizada',
            'data' => $cat_categories
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $cat_categories = Cat_categories::find($id);
        $cat_categories->id_status=2;
        $cat_categories->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Categoria eliminada',
             'data' => $cat_categories
         ]);
     }


}