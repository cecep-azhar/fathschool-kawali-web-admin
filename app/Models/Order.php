<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_no', 'user_id', 'transaction_type', 'payment_type', 'amount', 'status', 'type',
    ];
}
