<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo_sat_uso_cfdi extends Model
{
    use HasFactory;
    protected $table = "catalog_sat_cfdi_use";
    protected $fillable = [
        'id_sat',
        'nombre',
        'fisica',
        'moral',
        'fecha_inicio_vigencia',
        'fecha_fin_vigencia',
        'status',
        
    ];
}
