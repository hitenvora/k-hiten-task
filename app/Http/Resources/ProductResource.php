<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
			'product_name' => $this->product_name,
			'description' => $this->description,
			'meta_title' => $this->meta_title,
			'volume' => $this->volume,
			'meta_description' => $this->meta_description,
			'category' => $this->category,
			'sub_category' => $this->sub_category,
			'per_kg_price' => $this->per_kg_price,
            'per_gram_price' => $this->per_gram_price,
            'lush' => $this->lush,
            "decimal" => $this->decimal,
			'image' => $this->image,
			'inventorie' => $this->GetInventory ? $this->GetInventory->inventorie : 0 ,
			'barcodenumber' => $this->barcodenumber,
			'barcode_img' => $this->barcode_img,
			'gst' => $this->gst,
			'discount' => $this->discount,
			'firm_id' => $this->firm_id,
			'text_prize' => $this->text_prize,
            

        ];
    }
}
