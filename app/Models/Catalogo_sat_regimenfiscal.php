<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo_sat_regimenfiscal extends Model
{
    use HasFactory;
    protected $table = "catalog_sat_tax_regime";
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
