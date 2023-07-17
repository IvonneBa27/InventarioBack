<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\warehouse_entry_detail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\warehouse_entry_detailPostRequest;
use Illuminate\Support\Facades\DB;

class warehouse_entry_detailController extends Controller
{
    public function create(warehouse_entry_detailPostRequest $request){

           $incomeStoreDetail = warehouse_entry_detail::create([
            'warehouse_entry_id'=>$request['warehouse_entry_id'],
            'category_id'=>$request['category_id'],
            'subcategory_id'=>$request['subcategory_id'],
            'brand_id'=>$request['brand_id'],
            'product_id'=>$request['product_id'],
            'amount'=>$request['amount'],
            'total_received'=>$request['total_received'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Registro detallado agregado',
             'data' => $incomeStoreDetail
         ]);
     }

     public function get(){
            $incomeStoreDetail = warehouse_entry_detail::all();
            return response()->json([
             'status' => 'success',
             'msg' => 'Registros detallado obtenidos correctamente',
             'data' =>  $incomeStoreDetail
         ]);
     }
 

    public function getById(Request $request){  
        $id = $request->get('id'); 
        $incomeStoreDetail = warehouse_entry_detail::find($id);    
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro detallado obtenido por Id',
            'data' =>  $incomeStoreDetail
        ]);
    } 

    public function updateAmount(Request $request){
        $incomeStoreDetail =  warehouse_entry_detail::find($request['id']);
        $incomeStoreDetail->total_received=$request['total_received'];
        $incomeStoreDetail->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Monto actualizado',
            'data'   =>   $incomeStoreDetail
        ]);

    }


    
    

}