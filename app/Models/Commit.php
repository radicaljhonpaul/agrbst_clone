<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commit extends Model
{
    use HasFactory;

    public function CommitDemandTransactions(){
        return $this->hasMany(CommitDemandTransaction::class, 'commit_id', 'id');
    }

    public function Farmer(){
        return $this->hasOne(UserDetail::class, 'user_id', 'user_id');
    }

    public function ConsolidatedDemands(){
        return $this->hasOne(ConsolidatedDemand::class, 'id', 'consolidated_demand_id');
    }
}
