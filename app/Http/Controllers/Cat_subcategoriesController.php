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

    public function getByIdSubCat(Request $request){  
        $id = $request->get('id'); 
        $cat_subcategories = Cat_subcategories::where('id', '=',$id)->get();
    
        
        return response()->json([
            'status' => 'success',
            'msg' => ' Categoria obtenido correctamente',
            'data' => $cat_subcategories 
        ]);
    }


    
    

    //Select por IdCategoria para el modulo de Ingreso Detalle de Almacen
    public function getCatalog_Subcategorie(Request $request){  
        $id_category = $request->get('id_category'); 
        $cat_subcategories 
        =DB::table('catalog_subcategories')
           ->select('*')
           ->where('id_category','=',$id_category)
           ->get();

        return response()->json([
            'status' => 'success',
            'msg' => ' Categoria obtenido correctamente',
            'data' => $cat_subcategories 
        ]);
    }

    // Listas de SubCategorias
    public function get_List_Subcategorie(Request $request){  
        $id = $request->get('id_category'); 
        $cat_subcategories  = DB::SELECT('CALL get_list_subcategorie(?)', [$id]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de SubCategorias',
            'data' => $cat_subcategories 
        ]);
    }




    




    public function getByIdCat(Request $request){  
        $id = $request->get('id_category'); 
       // $cat_subcategories = Cat_subcategories::where('id_category', '=',$id)->get();
        
       /*$cat_subcategories
       =DB::table('cat_subcategories')
       //->select('cat_subcategories.id', 'cat_subcategories.name', 'cat_subcategories.created_at as registro', DB::raw("count('cat_brands.id') as totbrand"))
       ->select('cat_subcategories.id', 'cat_subcategories.name', 'cat_subcategories.created_at as registro', 'cat_brands.id as totbrand')
       ->leftJoin('cat_categories', 'cat_categories.id', '=', 'cat_subcategories.id_category')
      ->leftJoin('cat_brands', 'cat_subcategories.id', '=', 'cat_brands.id_subcategory')
       ->where('cat_subcategories.id_category', '=', $id)
      // ->groupBy('cat.brands.id')
       ->get();*/

       $cat_subcategories = DB::SELECT('CALL get_categorie_product(?)', [$id]);

       
        return response()->json([
            'status' => 'success',
            'msg' => 'SubCategoria por id  de Categoria obtenido correctamente',
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