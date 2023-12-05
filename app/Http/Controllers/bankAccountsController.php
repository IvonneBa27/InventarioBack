<?php

namespace App\Http\Controllers;

use App\Models\bankAccounts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class bankAccountsController extends Controller
{
    //

    public function indexbankAccounts()
    {
        $bankAccounts =DB::table('bank_accounts as ba')
                        ->select('bc.nombre as bank', 'ba.*')
                        ->join('banks_catalog as bc', 'ba.id_bank', '=', 'bc.id')
                        ->where('ba.id_status', '=', 1)
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuentas Bancarias',
            'data' => $bankAccounts
        ]);
    }

    public function createbankAccount(Request $request){
        $bankAccounts = bankAccounts::create([
            'account_number'=>$request['account_number'],
            'id_bank'=>$request['id_bank'],
            'branch'=>$request['branch'],
            'account_holder'=>$request['account_holder'],
            'executive'=>$request['executive'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'concentrator'=>$request['concentrator'],
            'accounting_account'=>$request['accounting_account'],
            'id_currency'=>$request['id_currency'],
            'id_complementary_account'=>$request['id_complementary_account'],
            'id_status'=>$request['id_status'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Cuentas Bancarias agregado',
             'data' => $bankAccounts
         ]);
    }

    public function getIdbankAccount(Request $request){  
        $id = $request->get('id'); 
        $bankAccounts = bankAccounts::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuenta Bancaria',
            'data' =>   $bankAccounts
        ]);
    }

    public function updatebankAccount(Request $request){
        $bankAccounts = bankAccounts::find($request['id']);  //Get parametro por metodo post    
        $bankAccounts->account_number=$request['account_number'];
        $bankAccounts->id_bank=$request['id_bank'];
        $bankAccounts->account_holder=$request['account_holder'];
        $bankAccounts->executive=$request['executive'];
        $bankAccounts->email=$request['email'];
        $bankAccounts->phone=$request['phone'];
        $bankAccounts->concentrator=$request['concentrator'];
        $bankAccounts->accounting_account=$request['accounting_account'];
        $bankAccounts->id_currency=$request['id_currency'];
        $bankAccounts->id_complementary_account=$request['id_complementary_account'];
        $bankAccounts->id_status=$request['id_status'];

        $bankAccounts->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuenta Bancaria actualizado',
            'data' =>$bankAccounts
        ]);
     }


     public function listbankComplementary(){
        $bankAccounts= DB::table('bank_accounts as ba')
                        ->select('ba.id', DB::raw("CONCAT(bc.nombre, '(', ba.account_number, ')') as complementary_bank"))
                        ->join('banks_catalog as bc', 'ba.id_bank', '=', 'bc.id')
                        ->where('ba.id_currency', '=', 1)
                        ->where('ba.id_status', '=', 1)
                        ->get();
                return response()->json([
                'status' => 'success',
                'msg' => 'Cuentas Bancarias',
                'data' => $bankAccounts
                ]);
     }
}
