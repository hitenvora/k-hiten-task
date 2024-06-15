<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCustomerModels extends Model
{
    protected $table = 'admin_customer';
    protected $primarykey = 'id';
    protected $fillable = ['first_name', 'last_name', 'email', 'contact_number','address','company_name','gst_number','type','cart_id'];
    public $timestamps = false;
    use HasFactory;
}
