<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;
    protected $table="catalog_company_subcategories";
    protected $fillable = [
        'nombre',
        'estatus',
    ];
}
