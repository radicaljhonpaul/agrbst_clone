<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelfLife extends Model
{
    use HasFactory;


    function AgrihubShelf() {
        return $this->hasMany(AgrihubShelf::class);
    }

    function Crop(){
        return $this->belongsTo(Crop::class);
    }





}
