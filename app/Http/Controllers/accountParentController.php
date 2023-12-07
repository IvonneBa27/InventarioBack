<?php

namespace App\Http\Controllers;

use App\Models\accountParent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class accountParentController extends Controller
{
    //

    
    public function indexCatalogAccount()
    {
        $parentAccount = DB::SELECT('CALL get_catalogAccount()');

 
        return response()->json([
            'status' => 'success',
            'msg' => 'Catalogo Contable',
            'data' => $parentAccount
        ]);
    }


    public function indexParentAccount()
    {
        $parentAccount =DB::table('parent_account')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuentas Contable Padre',
            'data' => $parentAccount
        ]);
    }

    public function createParentAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_description' => 'required',
            'levelA' => [
                'required',
                Rule::unique('parent_account', 'levelA')
                    ->where(function ($query) use ($request) {
                        // Agrega condiciones adicionales si es necesario
                    }),
            ],
            // Otras reglas de validación según sea necesario
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            
            // Verifica si hay un error específico para 'levelA'
            if ($errors->has('levelA')) {
                // Aquí puedes imprimir o devolver el mensaje específico para la duplicación
                $errorMessage = 'El nivel A ya está en uso.';
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error de validación',
                    'errors' => [
                        'levelA' => [$errorMessage],
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
    
        // Continuar con la lógica de creación del registro
        $parentAccount = accountParent::create([
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
            'msg' => 'Cuenta Contable Padre agregado',
            'data' => $parentAccount
        ]);
    }


    public function getIdParentAccount(Request $request){  
        $id = $request->get('id'); 
        $parentAccount = accountParent::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Cuenta Contable',
            'data' =>  $parentAccount
        ]);
    }


    public function updateParentAccount(Request $request){
        $parentAccount = accountParent::find($request['id']);  //Get parametro por metodo post    
        $parentAccount->account=$request['account'];
        $parentAccount->account_description=$request['account_description'];
        $parentAccount->levelA=$request['levelA'];
        $parentAccount->levelB=$request['levelB'];
        $parentAccount->levelC=$request['levelC'];
        $parentAccount->id_subcategory=$request['id_subcategory'];
        $parentAccount->id_status=$request['id_status'];

        $parentAccount->save();
        return response()->json([
            'status' => 'success',
            'msg'  => 'Cuenta Contable Padre actualizada',
            'data' => $parentAccount
        ]);
     }

}
