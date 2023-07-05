<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        //se valida la información que viene en $request
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:80',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:50'
        ]);

        //se crea el usuario en la base de datos
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role']
        ]);

        //se crea token de acceso personal para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //se devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        //valida las credenciales del usuario
        if (!Auth::attempt($request->only('usuario', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid access credentials'
            ], 200);
        }

        //Busca al usuario en la base de datos
        $user = User::where('usuario', $request['usuario'])->firstOrFail();
        $user['role'] = $user->role;
        //Genera un nuevo token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user
        ]);
    }

    public function dataUser(Request $request)
    {
        //devuelve la información del usuario
        return $request->user();
    }

    public function logout()
    {
        Auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'msg' => 'Sesión cerrada correctamente'
        ]);
    }


    public function sendEmail(Request $request)
    {

        $email = $request->email;



        $user = User::where('email', '=', $email)->get();


        if (count($user) > 0) {
            $randstring = Str::random(10);


            $newPass = Hash::make($randstring);
            $user = User::where('email', '=', $email)
                ->update(['password' => $newPass]);


            $emailData = [
                'to' => $email,
                'subject' => 'Recuperacion de contraseña',
                'message' => "<!DOCTYPE html>
                                <html>
                                <head>
                                    <meta charset='UTF-8'>
                                    <title></title>
                                </head>
                                <body>
                                    <img src='ruta_de_la_imagen' alt='Descripción de la imagen'>
                                    <h1>Título del correo electrónico</h1>
                                    <p>" . $randstring . "</p>
                                </body>
                                </html>
                                "];

            Mail::send([], $emailData, function ($message) use ($emailData) {
                $message->to($emailData['to'])
                    ->subject($emailData['subject'])
                    ->setBody($emailData['message'], 'text/html');
            });



            return response()->json(['status' => 'success', 'message' => 'Se envió su nueva contraseña a su correo.', 'data' => $randstring]);
        }
        return response()->json([
            'status'    => 'error',
            'msg'       => 'El correo ingresado no existe.',

        ]);


        //     $mailData = [
        //         'title' =>  'Dirsa México - Solicitud de nueva contrasña',
        //         'body' =>   'El cambio de contraseña se realizo correctamente.',
        //         'pass' =>   $randstring
        //     ];

        //     Mail::to($email)->send(new DemoMail($mailData));
        //     $newPass = Hash::make($randstring);

        //     $user = User::where('email', '=', $email)
        //         ->update(['password' => $newPass]);

        //     return response()->json([
        //         'status'    => 'success',
        //         'msg'       => 'Se ha enviado a su correo la nueva contraseña.',

        //     ]);
        // }

        // return response()->json([
        //     'status'    => 'error',
        //     'msg'       => 'El correo ingresado no existe.',

        // ]);


        // ->update(['title' => "Updated Title"]);


    }
}
