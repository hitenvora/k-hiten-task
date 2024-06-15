<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerchOrder extends Model
{
    use HasFactory;

	protected $fillable = ['bank_id'];
	protected $table = 'perch_orders';
	    public function PerchParty()
	{
		return $this->hasOne(PerchParty::class, 'id', 'partie_id');
	}

    public function GetAdminCart()
	{
		return $this->hasMany(PerchProduct::class, 'orders_id', 'id');
	}

	public function Product()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}

}
