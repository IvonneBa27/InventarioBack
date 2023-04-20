<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_categories extends Model
{
    use HasFactory;
    protected $table = "cat_categories";
    protected $fillable = [
        'name',
        'id_status',
    ];

    public function subcategories()
    {
        return $this->hasMany('App\Models\cat_subcategories', 'id_category', 'id');
    }

  

   


   
}
