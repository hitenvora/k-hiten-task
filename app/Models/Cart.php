<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function AppCart()
	{
		return $this->hasMany(AppOrderCart::class, 'cart_id', 'id');
	}

	public function AppCustomer()
	{
		return $this->hasOne(AdminCustomerModels::class, 'cart_Id', 'id');
	}

	public function WebCart()
	{
		return $this->hasMany(WebOrderCart::class, 'cart_id', 'id');
	}
}
