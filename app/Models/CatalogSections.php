<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogSections extends Model
{
    use HasFactory;

    protected $table="catalog_sections";
    
     protected $fillable = [
         'name',
         'status',
         'id_parent',
     ];
}
