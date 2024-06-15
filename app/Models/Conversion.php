<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;
    public function GetProductOne()
	{
		return $this->hasOne(Product::class, 'id', 'product_one_id');
	}
    public function GetProductTwo()
	{
		return $this->hasOne(Product::class, 'id', 'product_two_id');
	}
}
