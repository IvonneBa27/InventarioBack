<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrakingRecruitment extends Model
{
    use HasFactory;

    protected $table = "traking_recruitment";
    protected $fillable = [
        "fecha",
        "hora",
        "activdad",
        "comentario",
        "id_prospect",
        "id_recluter",
        "id_section"

    ];
}
