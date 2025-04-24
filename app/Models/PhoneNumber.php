<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'monthly_price',
        'setup_price',
        'currency',
    ];

    protected $casts = [
        'value' => 'string',
        'monthly_price' => 'float',
        'setup_price' => 'float',
        'currency' => 'string',
    ];
}
