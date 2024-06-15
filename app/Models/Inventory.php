<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    
	public function GetInventory()
	{
		return $this->hasOne(Inventory::class, 'product_id', 'product_id');
	}
}
