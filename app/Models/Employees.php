<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
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
        'fecha_ingreso',
        'fecha_nacimiento',
        'id_estatus',
        'id_departamento_empresa',
        'id_turno',
        'fecha_baja',
        'motivo_baja',
        'mes_baja',
        'img_profile',
        'contacto_emergencia_nombre',
        'contacto_emergencia_parentesco',
        'contacto_emergencia_telefono',
        'contacto_emergencia_tip_sangre',
        'contacto_emergencia_padecimientos',
        'contacto_emergencia_movil',
        'fecha_pago',
        'referencia',
        'colonia',
        'no_int',
        'cp',
        'tel_laboral',
        'nacionalidad',
        'id_estado_civil',
        'id_pais',
        'id_estado',
        'calle',
        'no_ext',
        'id_municipio',
        'tel_personal',
        'cause_id',
 
    ];


    public function gender()
    {
        return $this->hasOne('App\Models\Sexo', 'id', 'id_sexo');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'id_empresa_rh');
    }

    public function administrative_execution()
    {
        return $this->hasOne('App\Models\EjecucionAdministrativa', 'id', 'ejecucion_administrativa');
    }

}
