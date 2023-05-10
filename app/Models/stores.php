<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stores extends Model
{
    use HasFactory;
    protected $table = "stores";
    protected $fillable = [
        'name',
        'url_maps',
        'description',
        'id_status',
        'id_user',
        'essential_section',
    ];

   /* public function secctions()
    {
        return $this->hasMany('App\Models\secctions', 'id_store', 'id');
    }
    public function estatus()
    {
        return $this->hasOne('App\Models\Estatus', 'id', 'id_status');
    }

    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }*/



}
