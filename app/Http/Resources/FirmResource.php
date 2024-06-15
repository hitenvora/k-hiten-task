<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FirmResource extends JsonResource
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
			'name' => $this->name,
			'gst_text' => $this->gst_text,
        ];
    }
}
