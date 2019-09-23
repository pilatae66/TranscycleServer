<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustDetail extends Model
{
    protected $fillable= [
        'date_of_birth',
        'civil_status',
        'employment_type',
        'mobile_number',
        'landline_number',
        'place_of_birth',
        'religion',
        'email',
        'age',
        'educational_attainment'
    ];
}
