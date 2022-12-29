<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demand extends Model
{
    use HasFactory;

    protected $table = 'demands';
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function Crop(){
        return $this->belongsTo(Crop::class);
    }

    public function CommitDemandTransactions(){
        return $this->hasMany(CommitDemandTransaction::class, 'demand_id', 'id');
    }

    public function Trader(){
        return $this->hasOne(UserDetail::class, 'user_id', 'user_id');
    }
    
    public function ConsolidatedDemands(){
        return $this->hasOne(ConsolidatedDemand::class, 'id', 'consolidated_demand_id');
    }

    public function MappedTransaction(){
        return $this->hasOne(MappedTransaction::class, 'id', 'mapped_transaction_id');
    }
}


// use Illuminate\Database\Eloquent\SoftDeletes;

// class Demands extends Model 
// {

//     protected $table = 'demands';
//     public $timestamps = true;

//     use SoftDeletes;

//     protected $dates = ['deleted_at'];

//     public function user()
//     {
//         return $this->hasMany(Users_Details::class, 'id', 'fk_users_acc_id');
//     }

//     public function crops()
//     {
//         return $this->hasMany(Crops::class, 'id', 'fk_crops_id');
//     }

//     // public function bids()
//     // {
//     //     return $this->hasMany(Bids::class, 'id', 'fk_crops_id');
//     // }

//     public function consolidated_demands()
//     {
//         return $this->belongsTo(Consolidated_Demands::class, 'fk_consolidated_demands_id', 'id');
//     }

//     public function marketing_agreement_logs()
//     {
//         return $this->hasMany('Marketing_Agreement_Logs', 'id', 'fk_demands_id');
//     }

// }