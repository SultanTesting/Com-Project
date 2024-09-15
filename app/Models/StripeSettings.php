<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeSettings extends Model
{
    use HasFactory;

    protected $fillable = ['status',
    'account_mode',
    'country',
    'currency_name',
    'currency_icon',
    'currency_rate',
    'client_id',
    'secret_key'];
}
