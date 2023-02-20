<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catTipoProducto extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipoproducto',
    ];
}
