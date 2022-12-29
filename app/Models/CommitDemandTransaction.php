<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitDemandTransaction extends Model
{
    use HasFactory;
    protected $table = 'commit_demand_transactions';
    public $timestamps = true;
    
    public function Commits(){
        return $this->belongsTo(Commit::class, 'commit_id', 'id');
    }

    public function Demands(){
        return $this->belongsTo(Demand::class);
    }
}
