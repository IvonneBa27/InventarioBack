<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogRecruitmentSources extends Model
{
    use HasFactory;

    protected $table = "catalog_recruitment_sources";
    protected $fillable = [
        'name'

    ];
}
