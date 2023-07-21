<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transferStore extends Model
{
    use HasFactory;
    protected $table ="transfer_store";
    protected $fillable = [
        'store_origin_id',
        'section_origin_id',
        'store_destiny_id',
        'section_destiny_id',
        'category_id',
        'subcategory_id',
        'brand_id',
        'user_id',
        'observation',
        'id_status',
        'amount',
        'total_received',
        'income_id',
        'product_id',
    ];

}
