<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_subcategories extends Model
{
    use HasFactory;
    protected $table = "cat_subcategories";
    protected $fillable = [
        'name',
        'id_category',
        'id_status',
        'sku_indispensable',
    ];


  
}
