<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReturnProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return
        [
			'employee_id' => $this->employee_id,
			'cart_id' => $this->cart_id,
			'product_id' => $this->product_id,
			'firm_id' => $this->firm_id,
			'product_weight' => $this->product_weight,
			'product_price' => $this->product_price,
			'product_quntity' => $this->product_quntity,
			'taxes' => $this->taxes,
                'sub_total' => $this->sub_total,
            'total_amount' => $this->total_amount,
            "gst" => $this->gst,
                'return_product' => $this->return_product,
                'volume' => $this->Product->volume,
        ];
    }
}
