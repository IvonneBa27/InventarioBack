<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeBlood extends Model
{
    use HasFactory;
    protected $table = "type_bloods";
    protected $fillable = [
        'nombre',
        'id_estatus',
    ];
}
