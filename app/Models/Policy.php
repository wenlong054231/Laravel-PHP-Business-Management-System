<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $table = 'customers_policies';
    protected $fillable = [
        'customer_id',
        'premium',
        'insurance_type',
        'first_name',
        'last_name',
        'identification_number',
        'gender',
        'car_plate',
        'expired_date',
        'registered_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
