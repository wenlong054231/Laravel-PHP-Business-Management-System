<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    
    protected $table = 'sales';
    protected $fillable = [
      'policy_id',
      'companypolicy_id',
      'service_tax',
      'stamp_duty',      
    ];
}
