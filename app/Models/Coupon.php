<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'code',
    'quantity',
    'max_use',
    'start_date',
    'end_date',
    'discount',
    'discount_type',
    'status',
    'total_used'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime'
    ];



}
