<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppDetails extends Model
{
    protected $fillable = [
        'user_id',
        'purchased_product_id',
        'application_type',
        'customer_type',
        'requirements',
        'tin',
        'sss',
        'driver_license',
        'gsis'
    ];
}
