<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'idtipoProducto',
        'sku',
        'serial',
        'idMarca',
        'modelo',
        'skunum',
        'descripcion',
        'foto',
        'inventariable'
    ];
}
