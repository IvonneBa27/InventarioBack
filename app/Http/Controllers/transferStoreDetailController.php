<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transferStoreDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class transferStoreDetailController extends Controller
{


     public function create(Request $request){
     
        try{
            foreach($request->all() as $transfer){
                $transferStoreDetail = transferStoreDetail::create(
                    $transfer
                );
            }

            return response()->json([
                'status' => 'success',
                'msg' => 'Registro de detalle traspaso de Almacén',
                'data' =>  $transferStoreDetail
            ]);
        }
        catch (\Exception $e) {
            $error_code = $e->getMessage();
            return response()->json([
                'msg' => ' Error al crear el registro',
                'data' => $error_code
            ]);
           
        }
     }

     public function getListTransferProduct(Request $request)
     {
         $idIncome = $request->get('id'); 
         $transferStoreDetail= 
         DB::table('transfer_store_detail')
            ->select('product_income_store_detail.id as idDet', 'product_income_store_detail.product_name', 'product_income_store_detail.brand_name', 'product_income_store_detail.sku', 'product_income_store_detail.serial_number')
            ->join('product_income_store_detail','product_income_store_detail.id','=','transfer_store_detail.product_income_id')
             ->where('transfer_store_detail.id_transfer_store','=', $idIncome)
             ->get();
 
         return response()->json([
                 'status' => 'success',
                 'msg'  => 'Registro detallado por Almacen y Seccion',
                 'data' => $transferStoreDetail
             ]);
     }


  


}
