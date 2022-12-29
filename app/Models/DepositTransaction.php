<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositTransaction extends Model
{
    use HasFactory;


    public function MappedTransactions(){
        return $this->belongsTo(MappedTransaction::class);
    }

}
