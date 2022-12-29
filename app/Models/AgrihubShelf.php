<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgrihubShelf extends Model
{
    use HasFactory;

    function Crop(){
        return $this->belongsTo(Crop::class);
    }

    function CropVariety(){
        return $this->belongsTo(CropVariety::class);
    }

    function CropClass(){
        return $this->belongsTo(CropClass::class);
    }

    function ShelfLives(){
        return $this->belongsTo(ShelfLife::class);
    }
}
