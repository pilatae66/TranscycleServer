<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [ 'type', 'brand', 'model', 'color', 'price', 'downpayment', 'purchased_date' ];
}
