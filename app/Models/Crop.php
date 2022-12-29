<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;
    
    protected $table = 'crops';
    public $timestamps = true;

    public function CropPricing() {
        return $this->hasOne(CropPricing::class, 'crop_id', 'id');
    }

    public function CropVarieties(){
        return $this->hasMany(CropVariety::class);
    }

    public function CropClasses(){
        return $this->hasMany(CropClass::class);
    }

    public function CropProduction() {
        return $this->hasOne(CropProduction::class);
    }

    public function Demands() {
        return $this->hasMany(Demand::class);
    }

    public function Shelflife() {
        return $this->hasOne(Shelflife::class);
    }
}
