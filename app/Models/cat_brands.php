<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_brands extends Model
{
    use HasFactory;
    protected $table = "catalog_brands";
    protected $fillable = [
        'name',
        'id_status',
        'id_subcategory',
    ];
}
