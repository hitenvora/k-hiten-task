<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

	public function category()
	{
		return $this->hasOne(Category::class, 'id', 'categorieid');
	}

	public function products()
	{
		return $this->hasOne(Product::class, 'sub_category', 'id');
	}

	
	public function GetProducts()
	{
		return $this->hasMany(Product::class, 'sub_category', 'id');
	}

    public $timestamps = false;

}
