<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReturnPerchOrderResource extends JsonResource
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
			'orders_id' => $this->orders_id,
			'product_id' => $this->product_id,
			'product_price' => $this->product_price,
			'product_quntity' => $this->product_quntity,
			'taxes' => $this->taxes,
                'sub_total' => $this->sub_total,
                'volume' => $this->Product->volume,
            'text_prize' => $this->Product->text_prize,
            'gst' => $this->Product->gst,
            'decimal' => $this->Product->decimal,
            'per_kg_price' => $this->Product->per_kg_price,
            
        ];
    }
}
