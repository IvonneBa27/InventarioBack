<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermisse extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_usuario",
        "id_modulo",
        "create",
        "edit",
        "delete",
        "read",
    ];
}
