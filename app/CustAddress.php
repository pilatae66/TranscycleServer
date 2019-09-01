<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustAddress extends Model
{
    protected $fillable = [
        'purchased_product_id',
        'present_address',
        'langtitude',
        'longitude',
        'permanent_address'
    ];
}
