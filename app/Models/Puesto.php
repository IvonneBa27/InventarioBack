<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    protected $table="catalog_company_position";
    protected $fillable = [
        'nombre',
        'estatus',
    ];
}
