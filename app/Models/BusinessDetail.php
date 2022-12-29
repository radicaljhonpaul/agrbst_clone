<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    use HasFactory;

    public function BusinessDetailformat(){
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
