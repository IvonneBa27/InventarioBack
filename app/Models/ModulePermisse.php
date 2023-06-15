<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermisse extends Model
{
    use HasFactory;
    protected $table = "module_users_permissions";
    protected $fillable = [
        "id_usuario",
        "id_modulo",
        "show",
        "create",
        "edit",
        "delete",
        "read",
    ];
}
