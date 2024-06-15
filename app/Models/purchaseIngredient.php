<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchaseIngredient extends Model
{
    use HasFactory;
    public function GetIngredient()
	{
		return $this->hasOne(Ingredient::class, 'id', 'ingredient_id');
	}
}
