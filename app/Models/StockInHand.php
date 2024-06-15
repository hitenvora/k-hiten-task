<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInHand extends Model
{
    use HasFactory;

    public function GetProduct()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
}
