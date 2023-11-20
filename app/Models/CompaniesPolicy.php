<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesPolicy extends Model
{
    protected $table = 'companies_policies';
    protected $fillable = [
        'company_number',
        'premium',
        'insurance_type',
        'expired_date',
        'registered_date'
    ];
}
