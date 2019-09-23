<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustLiabilities extends Model
{
    protected $fillable = [
        'liability',
        'amount'
    ];
}
