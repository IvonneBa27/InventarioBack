<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionsPermissions extends Model
{
    use HasFactory;
    protected $table = "sections_permissions";
    protected $fillable = [
        "id",
        "id_section",
        "show",
        "id_user",
    ];
}
