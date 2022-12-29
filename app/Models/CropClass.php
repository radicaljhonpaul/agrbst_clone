<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropClass extends Model
{
    use HasFactory;

    function Crop(){
        return $this->belongsTo(Crop::class);
    }

    public function CropPricing(){
        return $this->hasOne(CropPricing::class);
    }
}
