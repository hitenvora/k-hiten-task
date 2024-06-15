<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return
        [
			'employee_id' => $this->employee_id,
			'cart_id' => $this->cart_id,
			'sub_total' => $this->sub_total,
			'taxes' => $this->taxes,
			'total_amount' => $this->total_amount,
        ];
    }
}
