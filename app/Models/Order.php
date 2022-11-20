<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_INITIATED = 0;
    const STATUS_PAYMENT_DONE = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_RETURNED = 3;
    const STATUS_CANCELLED = 3;

    protected $fillable = [
        'user_id',
        'status',
        'sub_amount',
        'tax_amount',
        'total_amount'
    ];

    /**
     * The products that belong to the user.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }

    /**
     * The transactions that belong to the user.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
