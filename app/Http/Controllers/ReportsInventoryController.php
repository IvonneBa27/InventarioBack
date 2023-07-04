<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoresExit;
use App\Models\StoresExitDetails;
use App\Models\transferStore;
use App\Models\transferStoreDetail;
use App\Models\stores;
use App\Models\secctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReportsInventoryController extends Controller
{
    //

    public function getReportsInventoryAll(){
 
         $reports = DB::SELECT('CALL get_list_inventory_store()');
 
            return response()->json([
             'status' => 'success',
             'msg' => 'Reporte de Inventario',
             'data' => $reports
         ]);
 
 
     }
}
