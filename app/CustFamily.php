<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustFamily extends Model
{
    protected $fillable = [
        'father_name',
        'mother_name',
        'spouse_name',
        'dependent1',
        'dependent2',
        'dependent3',
    ];
}
