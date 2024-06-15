<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productIngredient extends Model
{
    use HasFactory;
    protected $table = "product_ingredien"; 

    public function GetProduct()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
}
