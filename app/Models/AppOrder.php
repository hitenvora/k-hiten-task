<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppOrder extends Model
{
    use HasFactory;

    public function GetCart()
	{
		return $this->hasOne(Cart::class, 'id', 'cart_id');
	}
	
	public function Customer()
	{
		return $this->hasOne(AdminCustomerModels::class, 'id', 'admin_client_id');
	}

	public function GetAdminCart()
	{
		return $this->hasMany(AdminOrderCart::class, 'app_orders_id', 'id');
	}
	public function GetwebCart()
	{
		return $this->hasMany(WebOrderCart::class, 'cart_id', 'cart_id');
	}
	
	public function Product()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
	

	public function GetAddress()
	{
		return $this->hasOne(OrderAddress::class, 'id', 'address_id');
	}
	

	public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
	}


}
