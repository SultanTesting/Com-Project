<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalSettings extends Model
{
    use HasFactory;

    protected $fillable = ['status',
    'account_mode',
    'country',
    'currency_name',
    'currency_icon',
    'currency_rate',
    'paypal_client_id',
    'paypal_sec_key'];
    
}
