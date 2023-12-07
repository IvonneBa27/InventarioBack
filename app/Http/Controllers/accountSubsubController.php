<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\accountSubsub;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class accountSubsubController extends Controller
{
    //

    public function indexSubsubAccount(Request $request)
    {
        $id = $request->get('id'); 
        $id_parent =  $request->get('id_parent');

        $subsubAccount = DB::table('sub_subaccount')
                        ->where('id_parent', '=', $id_parent)
                        ->where('id_sub', '=', $id)
                        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuentas Contable Subsub',
            'data' => $subsubAccount
        ]);
    }

    public function createSubsubAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_description' => 'required',
            'levelC' => [
                'required',
                Rule::unique('sub_subaccount', 'levelC')
                    ->where(function ($query) use ($request) {
                        // Agrega condiciones adicionales si es necesario
                    }),
            ],
            // Otras reglas de validación según sea necesario
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            
            // Verifica si hay un error específico para 'levelA'
            if ($errors->has('levelC')) {
                // Aquí puedes imprimir o devolver el mensaje específico para la duplicación
                $errorMessage = 'El nivel C ya está en uso.';
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
    
    
             $subsubAccount = accountSubsub::create([
            'id_parent' => $request['id_parent'],
            'id_sub' => $request['id_sub'],
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
            'msg' => 'Cuenta Contable Subsub agregado',
            'data' => $subsubAccount
        ]);
    }

    public function getIdSubsubAccount(Request $request){  
        $id = $request->get('id'); 
        $subsubAccount = accountSubsub::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuenta Contable',
            'data' =>  $subsubAccount
        ]);
    }

    

    public function updateSubsubAccount(Request $request){
        $subsubAccount = accountSubsub::find($request['id']);  //Get parametro por metodo post    
        $subsubAccount ->id_parent=$request['id_parent'];
        $subsubAccount ->id_sub=$request['id_sub'];
        $subsubAccount ->account=$request['account'];
        $subsubAccount ->account_description=$request['account_description'];
        $subsubAccount ->levelA=$request['levelA'];
        $subsubAccount ->levelB=$request['levelB'];
        $subsubAccount ->levelC=$request['levelC'];
        $subsubAccount ->id_subcategory=$request['id_subcategory'];
        $subsubAccount ->id_status=$request['id_status'];

        $subsubAccount->save();
        return response()->json([
            'status' => 'success',
            'msg'  => 'Cuenta Contable Sub actualizada',
            'data' => $subsubAccount 
        ]);
     }
}
