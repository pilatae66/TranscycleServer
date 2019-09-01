<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppDetails extends Model
{
    protected $fillable = [
        'user_id',
        'application_type',
        'customer_type',
        'requirements',
        'tin',
        'gsis',
        'driver_license',
        'gsis'
    ];
}
