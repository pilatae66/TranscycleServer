<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustAddress extends Model
{
    protected $fillable = [
        'present_address',
        'lat',
        'lng',
        'permanent_address'
    ];
}
