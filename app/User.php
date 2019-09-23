<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'middlename', 'lastname', 'username', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname) ." ". ucfirst($this->middlename[0]) .". ". ucfirst($this->lastname);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function purchased_products()
    {
        return $this->hasMany(PurchasedProduct::class);
    }

    public function cust_details()
    {
        return $this->hasOne(CustDetail::class);
    }

    public function cust_family()
    {
        return $this->hasMany(CustFamily::class);
    }

    public function cust_address()
    {
        return $this->hasOne(CustAddress::class);
    }

    public function cust_income()
    {
        return $this->hasMany(CustIncome::class);
    }

    public function cust_liability()
    {
        return $this->hasMany(CustLiabilities::class);
    }

    public function cust_self_employed()
    {
        return $this->hasOne(SelfEmployedCust::class);
    }

    public function cust_employed()
    {
        return $this->hasOne(EmployedCust::class);
    }

    public function cust_employment_details()
    {
        return $this->cust_details->employment_type === 'Self-Employed' ? $this->hasOne(SelfEmployedCust::class) : $this->hasOne(EmployedCust::class);
    }

    public function cust_references()
    {
        return $this->hasMany(CustReference::class);
    }
}
