<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventories extends Model
{
    protected $fillable = [
        'opening_stock', // Add opening_stock here
    ];
    use HasFactory;
}
