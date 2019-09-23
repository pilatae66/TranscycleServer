<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustIncome extends Model
{
    protected $fillable = [
        'source_of_income',
        'who',
        'amount'
    ];
}
