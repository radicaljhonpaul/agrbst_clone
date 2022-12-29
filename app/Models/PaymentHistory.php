<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    public function MappedTransaction(){
        return $this->hasOne(MappedTransaction::class, 'id', 'mapped_transaction_id');
    }
}
