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
                'message' => 'Acceso inválido'
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


            $nombre  = $user[0]->nombre_completo;
            $usuario = $user[0]->usuario;

            $newPass = Hash::make($randstring);
            $user = User::where('email', '=', $email)
                ->update(['password' => $newPass]);


            $emailData = [
                'to' => $email,
                'subject' => 'Recuperacion de contraseña',
                'message' => '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
</head>
<body bgcolor="#FFFFFF">
    <table width="650" border="0" align="center" cellpadding="0" cellspacing="0"
        style="border-collapse: separate; border-spacing: 10px;">
        <tr>
            <td width="25">&nbsp;</td>
            <td>
                <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"
                    style="vertical-align: top; font-family: arial; font-size: 12px; color: #7a7a7a; ">
                    <tr>
                        <td>
                            <div style="left: 0;padding: 12px;width: 190px;"><img
                                    src="https://intranet.doitright.solutions/admin/img/logotipo_doitright.png"
                                    width="160"></div>
                        </td>
                        <td>&nbsp;</td>
                        <td>
                            <h1 style="color:#999; font:normal normal 24px/1.2 Arial, Helvetica, sans-serif">Sistema BAVER v1.0</h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td width="25">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0"
                    style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#7a7a7a; line-height:1.4;">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr style="height:150px; vertical-align:top;">
                        <td>&nbsp;</td>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="text-align:left; color:#666;">
                                <tr>
                                    <th scope="row" style="font-size: 18px;">Nombre: ' . $nombre . '</th>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size: 18px;">Tus datos para ingresar son:</th>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size: 18px;">Usuario:  ' . $usuario . '</th>
                                </tr>
                                <tr style="margin-top: 15px;">
                                    <th scope="row" style=" font-size: 18px;">Contraseña:  '.$randstring .'</th>
                                </tr>
                                <tr style="margin-top: 15px;">
                                    <th scope="row" style=" font-size: 18px;">Ligase de acceso: <a href="https://10.150.80.252:3200/">https://10.150.80.252:3200/</a>
                                        </th>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><strong>
                                <p>Do It Right S.A. de C.V. Av. Gustavo Baz Prada 98-Piso 7, Industrial, Alce Blanco
                                    C.P.53370 Naucalpan de Juárez,
                                    Estado de México, México. <a
                                        href="mailto:comunicacion@dirsamexico.com">comunicacion@dirsamexico.com</a> 01
                                    (+52) 5571581257</p>
                            </strong>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:11px;color:#7a7a7a; line-height:1.4;">
                <p>La información transmitida está destinada solo a la persona que se dirige este material o contenido
                    el cual es confidencial. Cualquier modificación, difusión u otro uso en base a esta información por
                    personas o entidades distintas al destinatario está prohibido. Si recibió este correo por error,
                    favor de contactar al remitente y eliminar el material re su equipo de cómputo.</p>
            </td>
            <td align="center">&nbsp;</td>
        </tr>
    </table>
</body>
</html>
                                '];

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


        

    }
}
