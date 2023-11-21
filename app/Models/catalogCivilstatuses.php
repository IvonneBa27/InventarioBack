<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogCivilstatuses extends Model
{
    use HasFactory;
    protected $table = "catalog_civil_statuses";
    protected $fillable = [
        'nombre',
        'id_estatus',
    ];
}
