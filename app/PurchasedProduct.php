<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    protected $fillable = [
        'term',
        'amount_finance',
        'amount_due',
        'monthly_amortization',
        'priority_level',
        'MC_user_type',
        'loan_purpose',
        'sales_agent',
        'user_id',
        'product_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function app_details()
    {
        return $this->hasOne(AppDetails::class);
    }

    public function app_requirements()
    {
        return $this->hasMany(AppRequirements::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
