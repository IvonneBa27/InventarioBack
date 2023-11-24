<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    use HasFactory;
    protected $primaryKey = 'idpais';
    protected $table = "countries";
    protected $fillable = [
        'idpais',
        'pais',
        'clavesat',
        'formato',
        'activo',
        
    ];
}
