<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount', 'payment_type', 'paid_to', 'remarks', 'purchased_product_id', 'user_id'
    ];

    public function cashier()
    {
        return $this->hasOne(User::class, 'id', 'paid_to');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function purchased_product()
    {
        return $this->belongsTo(PurchasedProduct::class);
    }
}
