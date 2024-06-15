<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
     
        'first_name',
        'last_name',
        'email',
        'mobile_no',
        'altrnate_mobile_no',
        'contry',
        'city',
        'state',
        'addresss',
        'landmark',
        'pincode',
        'address_type',
        'user_id',
        'product_id',
        'cart_id',
    ];
}
