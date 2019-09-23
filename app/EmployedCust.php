<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployedCust extends Model
{
    protected $fillable = [
        'type_of_org',
        'company_name',
        'length_of_stay',
        'address',
        'landline_number',
        'mobile_number',
        'nature_of_business',
        'position',
        'employment_status'
    ];
}
