<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropProduction extends Model
{
    use HasFactory;

    public function Crop()
    {
        # code...
        return $this->belongsTo(Crop::class);
    }

    public function CropProductionHarvestingModels()
    {
        # code...
        return $this->hasMany(CropProductionHarvestingModel::class);
    }
}
