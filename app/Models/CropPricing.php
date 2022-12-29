<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CropPricing extends Model
{
    use HasFactory;

    protected $table = 'crop_pricings';
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function Crop(){
        return $this->belongsTo(Crop::class);
    }

    public function CropClass(){
        return $this->belongsTo(CropClass::class);
    }

    public function CropVariety(){
        return $this->belongsTo(CropVariety::class);
    }

    /**
     * Get the Crop that owns the CropPricing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function Crop(): BelongsTo
    // {
    //     return $this->belongsTo(Crop::class, 'foreign_key', 'other_key');
    // }

}
