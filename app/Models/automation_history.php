<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class automation_history extends Model
{
    use HasFactory;

    protected $table = 'automation_history';

// reletionship
    public function GetAutomationHistory()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
}
