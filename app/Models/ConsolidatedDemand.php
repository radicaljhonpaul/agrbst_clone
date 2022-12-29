<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidatedDemand extends Model
{
    use HasFactory;

    protected $table = 'consolidated_demands';

    public function Demands(){
        return $this->hasMany(Demand::class);
    }

    public function Crop(){
        return $this->hasOne(Crop::class, 'id', 'crop_id');
    }

    public function CropPricing() {
        return $this->hasOne(CropPricing::class, 'id', 'price_id');
    }
    
    // public function CommitDemandTransactions(){
    //     return $this->hasManyThrough(CommitDemandTransaction::class, Demand::class);
    // }
}
