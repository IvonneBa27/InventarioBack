<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prospectEmployee extends Model
{
    use HasFactory;
    protected $table = "prospect_employee";
    protected $fillable = [
      //  'number',
        'date',
        'platform',
        'name_full',
        'mail',
        'phone',
        //'age',
        'english_level',
        'service_experience',
        'state_residence',
        'municipality_delegations',
        'personal_computer',
        'internet_provider',
        'financial_dependents',
        'experience_computer',
        'labor_days',
        'dual_monitor',
        'monthly_salary',
        'means_communication',
        'educational_level',
        'campaign',
        'birthdale',
    ];
}
