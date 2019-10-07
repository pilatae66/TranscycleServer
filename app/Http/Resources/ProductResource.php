<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'type' => $this->type,
            'brand' => $this->brand,
            'model' => $this->model,
            'color' => $this->color,
            'price' => '₱' . number_format($this->price, 2, '.', ','),
            'downpayment' => '₱' . number_format($this->downpayment, 2, '.', ','),
            'date_registered' => Carbon::parse($this->purchased_date)->toDateString()
        ];
    }
}
