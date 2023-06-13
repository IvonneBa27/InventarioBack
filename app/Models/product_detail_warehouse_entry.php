<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_detail_warehouse_entry extends Model
{
    use HasFactory;
    protected $table = "product_income_store_detail";
    protected $fillable = [
        'warehouse_entry_detail_id',
        'product_id',
        'product_name',
        'brand_name',
        'sku',
        'serial_number',
        'amount',

    ];
}
