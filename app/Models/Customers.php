<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = "customers";

    protected $fillable = [
        'no_cliente',
        'razon_social',
        'rfc',
        'idPais',
        'idCiudad',
        'idMunicipio',
        'calle',
        'no_ext',
        'no_int',
        'colonia',
        'cp',
        'sitio_web',
        'url_map',
        'observaciones',
        'cp_fiscal',
        'idUsoCfdi',
        'idRegimenFiscal',
        'nombre_completo',
        'email',
        'movil',
        'tel_trabajo',
        'ext',
        'puesto',
        'nombre_completo_tecnico',
        'email_tecnico',
        'movil_tecnico',
        'tel_trabajo_tecnico',
        'ext_tecnico',
        'puesto_tecnico',
        'nombre_completo_pago',
        'email_pago',
        'movil_pago',
        'tel_trabajo_pago',
        'ext_pago',
        'puesto_pago',
        'idestatus',

      
    ];

 
}
