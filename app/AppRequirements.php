<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppRequirements extends Model
{
    protected $fillable = [
        'requirement_name', 'purchased_product_id'
    ];

    public function purchased_product()
    {
        return $this->belongsTo(PurchasedProduct::class);
    }
}
