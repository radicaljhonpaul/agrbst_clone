<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropProductionHarvestingModel extends Model
{
    use HasFactory;

    public function CropProduction()
    {
        # code...
        return $this->belongsTo(CropProductionHarvestingModel::class);
    }
}
