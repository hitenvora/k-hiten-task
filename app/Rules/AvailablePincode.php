<?php

namespace App\Rules;

use App\Models\OrderPincode;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;


class AvailablePincode implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the pincode exists in the order_pincodes table
        return OrderPincode::where('pincode', $value)->exists();
    }

    public function message()
    {
        return 'The service is not available for the provided pincode.';
    }
}
