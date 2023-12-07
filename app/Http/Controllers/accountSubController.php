<?php

namespace App\Http\Controllers;

use App\Models\accountSub;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class accountSubController extends Controller
{
    

    public function indexSubAccount(Request $request)
    {
        $id = $request->get('id_parent'); 
        $subAccount = DB::table('sub_account')
                        ->where('id_parent', '=', $id)
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuentas Contable Sub',
            'data' => $subAccount
        ]);
    }

    public function createSubAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_description' => 'required',
            'levelB' => [
                'required',
                Rule::unique('sub_account', 'levelB')
                    ->where(function ($query) use ($request) {
                        // Agrega condiciones adicionales si es necesario
                    }),
            ],
            // Otras reglas de validación según sea necesario
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            
            // Verifica si hay un error específico para 'levelA'
            if ($errors->has('levelB')) {
                // Aquí puedes imprimir o devolver el mensaje específico para la duplicación
                $errorMessage = 'El nivel B ya está en uso.';
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error de validación',
                    'errors' => [
                        'levelB' => [$errorMessage],
                    ],
                ], 422);
            }
    
            // Manejo de otros errores si es necesario
            return response()->json([
                'status' => 'error',
                'msg' => 'Error de validación',
                'errors' => $errors,
            ], 422);
        }
    
    
             $subAccount = accountSub::create([
            'id_parent' => $request['id_parent'],
            'account' => $request['account'],
            'account_description' => $request['account_description'],
            'levelA' => $request['levelA'],
            'levelB' => $request['levelB'],
            'levelC' => $request['levelC'],
            'id_subcategory' => $request['id_subcategory'],
            'id_status' => $request['id_status'],
        ]);
    
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuenta Contable Sub agregado',
            'data' => $subAccount
        ]);
    }

    public function getIdSubAccount(Request $request){  
        $id = $request->get('id'); 
        $subAccount = accountSub::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuenta Contable',
            'data' =>  $subAccount
        ]);
    }

    

    public function updateSubAccount(Request $request){
        $subAccount = accountSub::find($request['id']);  //Get parametro por metodo post    
        $subAccount->id_parent=$request['id_parent'];
        $subAccount->account=$request['account'];
        $subAccount->account_description=$request['account_description'];
        $subAccount->levelA=$request['levelA'];
        $subAccount->levelB=$request['levelB'];
        $subAccount->levelC=$request['levelC'];
        $subAccount->id_subcategory=$request['id_subcategory'];
        $subAccount->id_status=$request['id_status'];

        $subAccount->save();
        return response()->json([
            'status' => 'success',
            'msg'  => 'Cuenta Contable Sub actualizada',
            'data' => $subAccount
        ]);
     }





}
