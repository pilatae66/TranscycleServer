<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelfEmployedCust extends Model
{
    protected $fillable = [
        'business_name',
        'nature_of_business',
        'address',
        'landline_number',
        'mobile_number'
    ];
}
