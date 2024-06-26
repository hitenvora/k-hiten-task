<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingProduct extends Model
{
    use HasFactory;
public function Product()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
