<?php

namespace App\Http\Resources;

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
                'employment_details' => $this->user->cust_employment_details,
                'references' => $this->user->cust_references
            ],
            'product' => $this->product,
            'app_details' => $this->app_details,
            'term' => $this->term,
            'amount_finance' => $this->amount_finance,
            'monthly_amortization' => $this->monthly_amortization,
            'priority_level' => $this->priority_level,
            'MC_user_type' => $this->MC_user_type,
            'loan_purpose' => $this->loan_purpose,
            'sales_agent' => $this->sales_agent,
            'requirements' => $this->app_requirements
        ];
    }
}
