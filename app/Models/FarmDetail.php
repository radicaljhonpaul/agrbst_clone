<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmDetail extends Model
{
    use HasFactory;

    // protected $table = 'farm_details';
    // public $timestamps = true;

    // use SoftDeletes;

    // protected $dates = ['deleted_at'];

    public function FarmDetailformat(){
        return [
            'farm_name' => $this->farm_name,
            'farm_size' => $this->farm_size,
            'region' => $this->region,
            'province' => $this->province,
            'city' => $this->city,
            'brgy' => $this->brgy,
            'long' => $this->long,
            'lat' => $this->lat,
        ];
    }
    
    public function UserDetail()
    {
        return $this->belongsTo(UserDetail::class);
    }
}
