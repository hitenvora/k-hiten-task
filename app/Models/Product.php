<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function GetCategory()
	{
		return $this->hasOne(Category::class, 'id', 'category');
	}

    public function subCategory()
	{
		return $this->hasOne(SubCategory::class, 'id', 'sub_category');
	}

	public function getFirm()
	{
		return $this->hasOne(Firm::class, 'id', 'firm_id');
	}

	public function getProductIngredient()
	{
		return $this->hasMany(productIngredient::class, 'product_id', 'id');
	}
	public function conversion()
    {
        return $this->belongsTo(Conversion::class, 'product_one_id', 'id');
    }

	public function GetInventory()
	{
		return $this->hasOne(Inventory::class, 'product_id', 'id');
	}
}
