<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    use HasFactory;

    public function gst()
    {
        // Explode the comma-separated values and fetch related ChildModels
        return GstAndTextCategory::whereIn('id', explode(',', $this->gst_text))->orderBy('id', 'DESC')->get();
    }
}
