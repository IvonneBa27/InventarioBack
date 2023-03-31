<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = [
        'id_tipo_usuario',
        'usuario',
        'nombre',
        'apellido_pat',
        'apellido_mat',
        'id_ubicacion',
        'id_empresa_rh',
        'email_personal',
        'email',
        'password',
        'numero_empleado',
        'nombre_completo',
        'curp',
        'rfc',
        'nss',
        'id_sexo',
        'id_subcategoria',
        'ejecucion_administrativa',
        'id_puesto',
        'sueldo',
        'id_banco',
        'numero_cuenta_bancaria',
        'clabe_inter_bancaria',
        'fecha_ingreso',        'fecha_nacimiento',
        'id_estatus',
        'id_departamento_empresa',
        'id_turno',
        'fecha_baja',
        'motivo_baja',
        'mes_baja',
        'img_profile',
    ];



    public function puesto()
    {
        return $this->hasOne('App\Models\Puesto', 'id', 'id_tipo_usuario');
    }
}
