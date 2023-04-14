<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegaciones extends Model
{
    use HasFactory;
    protected $table = "delegaciones";
    protected $fillable = [
        'iddelegacion',
        'idpais',
        'idciudad',
        'delegacion',
        'activo',
        
    ];
}
