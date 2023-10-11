<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CatalogSectionCreateRequest;
use App\Models\CatalogSections;
use Illuminate\Support\Facades\DB;
use App\Models\catModulo;

class CatalogSectionController extends Controller
{
    //
    public function create(CatalogSectionCreateRequest $request){

        $sectionmodule = CatalogSections::create([
            'name'=>$request['name'],
            'status'=>$request['status'],
            'id_parent'=>$request['id_parent'],
           
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Secion agregado',
             'data' => $sectionmodule
         ]);
     }

     

     public function get(){
        $sectionmodule = CatalogSections::where('status','=',1)->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Seciones obtenidos correctamente',
            'data' => $sectionmodule
        ]);
    }

    public function getById(Request $request){  
        $id = $request->get('id'); 
        $sectionmodule = CatalogSections::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Secion por id obtenido correctamente',
            'data' => $sectionmodule
        ]);
    }

     // Listas de SubSecciones
     public function get_ListSubsections(Request $request){  
        $id = $request->get('id_parent'); 
        
       // $sectionmodule = CatalogSections::where('id_parent', '=',$id)->get();
          $sectionmodule =   DB::table('catalog_sections')
                            ->select('catalog_sections.id', 'catalog_sections.name', 'status.nombre as Estatus')
                            ->join('status','catalog_sections.status','=','status.id')
                            ->where('catalog_sections.id_parent','=',$id)
                            ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de SubSecciones',
            'data' => $sectionmodule
        ]);
    }

    public function update(Request $request){
        
        $sectionmodule = CatalogSections::find($request['id']);   
        $sectionmodule->name=$request['name'];
        $sectionmodule->status=$request['status'];
        $sectionmodule ->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Subseccion actualizado',
            'data' =>$sectionmodule
        ]);

     }

     public function delete(Request $request){
        $id = $request->get('id');
        $sectionmodule = CatalogSections::find($id);
        $sectionmodule ->status=2;
        $sectionmodule ->save();

         return response()->json([
             'status' => 'success',
             'msg' => 'Subseccion eliminado',
             'data' =>  $sectionmodule 
         ]);
     }


}
