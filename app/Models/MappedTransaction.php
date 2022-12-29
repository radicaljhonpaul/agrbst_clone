<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappedTransaction extends Model
{
    use HasFactory;


    public function DepositTransactions(){
        return $this->hasMany(DepositTransaction::class, 'mapped_transaction_id','id');
    }

    public function OnhandTransaction(){
        return $this->hasOne(OnhandTransaction::class);
    }
    
    public function Demands(){
        return $this->hasMany(Demand::class, 'mapped_transaction_id','id');
    }

    public function PaymentHistory(){
        return $this->hasMany(PaymentHistory::class, 'mapped_transaction_id','id');
    }

    public function UserDetail(){
        return $this->hasOne(UserDetail::class, 'id','user_id');
    }

}
