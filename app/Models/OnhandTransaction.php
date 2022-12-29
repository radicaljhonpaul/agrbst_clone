<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnhandTransaction extends Model
{
    use HasFactory;

    public function MappedTransaction(){
        return $this->belongsTo(MappedTransaction::class);
    }

}
