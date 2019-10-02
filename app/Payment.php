<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount', 'payment_type', 'paid_to', 'remarks'
    ];

    public function cashier()
    {
        return $this->hasOne(User::class, 'id', 'paid_to');
    }
}
