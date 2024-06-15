<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOrderCart extends Model
{
    use HasFactory;

    public function Product()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}

	public function Customer()
	{
		return $this->hasOne(AdminCustomerModels::class, 'id', 'Client_id');
	}

	protected $fillable = ['return_order'];   
}
