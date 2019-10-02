<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'payment_type' => $this->payment_type,
            'amount' => $this->amount,
            'paid_to' => $this->cashier,
            'remarks' => $this->remarks,
            'purchased_product' => $this->purchased_product,
            'customer' => $this->customer,
            'branch' => $this->cashier->branch,
            'product' => $this->purchased_product->product
        ];
    }
}
