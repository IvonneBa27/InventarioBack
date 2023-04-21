<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producs extends Model
{
    use HasFactory;
    protected $table = "producs";
    protected $fillable = [
       // 'name',
        'id_categoty',
        'id_subcategory',
        'sku',
        'seria_number',
        'id_brand',
        'model',
        'description',
        'inventory',
        'photo',
        'id_status',
        'id_unitmeasure',
    ];
}
