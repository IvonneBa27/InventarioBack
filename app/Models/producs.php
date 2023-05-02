<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producs extends Model
{
    use HasFactory;
    protected $table = "producs";
    protected $fillable = [
        'name',
        'id_categoty',
        'id_subcategory',
        'sku',
        'serial_number',
        'id_brand',
        'model',
        'description',
        'inventory',
        'photo',
        'id_status',
        'id_unitmeasure',
    ];

    public function categories()
    {
        return $this->hasOne('App\Models\cat_categories', 'id', 'id_categoty');

       
    }

    public function subcategories()
    {
        return $this->hasOne('App\Models\cat_subcategories', 'id', 'id_subcategory');
    }

    public function marca()
    {
        return $this->hasOne('App\Models\cat_brands', 'id', 'id_brand');
    }

    public function estatus()
    {
        return $this->hasOne('App\Models\Estatus', 'id', 'id_status');
    }
}
