<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse_entry_detail extends Model
{
    use HasFactory;
    protected $table = "warehouse_entry_detail";
    protected $fillable = [
        'warehouse_entry_id',
        'category_id',
        'subcategory_id',
        'brand_id',
        'product_id',
        'amount',
        'total_received',
    ];
}
