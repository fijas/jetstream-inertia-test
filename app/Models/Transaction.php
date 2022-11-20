<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const STATUS_PAYMENT_INITIATED = 0;
    const STATUS_PAYMENT_COMPLETED = 1;
    const STATUS_PAYMENT_FAILED = 2;

    const TYPE_CREDIT_CARD = 0;
    const TYPE_BANK = 0;

    protected $fillable = [
        'order_id',
        'status',
        'amount',
        'type',
    ];
}
