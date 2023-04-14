<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = "suppliers";
    protected $fillable = [
        'no_proveedor',
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
        'dias_credito',
        'idBanco',
        'no_cuenta',
        'clabe_intenbancaria',
        'nombre_completo',
        'email',
        'tel_movil',
        'tel_trabajo',
        'ext',
        'puesto',
        'idestatus',
    
    ];

 

}
