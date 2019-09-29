<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CostumerResource extends JsonResource
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
            'name' => $this->full_name,
            'address' => $this->cust_address,
            'details' => $this->cust_details,
            'family' => $this->cust_family,
            'income' => $this->cust_income,
            'liability' => $this->cust_liability,
            'employment_details' => $this->cust_employment_details,
            'references' => $this->cust_references
        ];
    }
}
