<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchasedProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => [
                'id' => $this->user->id,
                'name' => $this->user->full_name,
                'address' => $this->user->cust_address,
                'details' => $this->user->cust_details,
                'family' => $this->user->cust_family,
                'income' => $this->user->cust_income,
                'liability' => $this->user->cust_liability,
                'employment_details' => $this->user->cust_employment_details
            ],
            'product' => $this->product,
            'product_name' => "{$this->product->brand} {$this->product->model}",
            'app_details' => $this->app_details,
            'due_date' => $this->due_date,
            'term' => $this->term,
            'amount_finance' => "₱".number_format($this->amount_finance, 2, '.', ','),
            'amount_due' => "₱".number_format($this->amount_due, 2, '.', ','),
            'monthly_amortization' => "₱".number_format($this->monthly_amortization, 2, '.', ','),
            'priority_level' => $this->priority_level,
            'MC_user_type' => $this->MC_user_type,
            'loan_purpose' => $this->loan_purpose,
            'sales_agent' => User::find($this->sales_agent)->full_name,
            'requirements' => $this->app_requirements,
            'payments' => $this->payments,
            'total_payment' => $this->payments->sum('amount')
        ];
    }
}
