<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relationship extends Model
{
    use HasFactory;
    protected $table = "relationships";
    protected $fillable = [
        'nombre',
        'id_estatus',
    ];
}
