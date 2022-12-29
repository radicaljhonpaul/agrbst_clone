<?php

namespace App\Repositories;

use App\Interfaces\InventoryAndOrdersInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Models\Commit;
use App\Models\CommitDemandTransaction;
use App\Models\ConsolidatedDemand;
use App\Models\CropPricing;
use App\Models\User;
use App\Models\Demand;
use App\Models\MappedTransaction;
use Carbon\Carbon;

class InventoryAndOrdersRepository implements InventoryAndOrdersInterface 
{

    public function getAllDemandsSupplyAssessmentInADay() 
    {
        return "getAllDemandsSupplyAssessmentInADay";
    }

    public function getConsolidatedDemandsByDateInAMonth($month) 
    {
        return ConsolidatedDemand::with(['Demands' => function($e){
            return $e->select('id','consolidated_demand_id')->withCount('CommitDemandTransactions')->get();
        }])
        ->withCount('Demands')
        ->with('Crop')
        ->whereMonth('date', $month);
    }

    public function getConsolidatedDemandsByDate($date) 
    {
        return ConsolidatedDemand::with(['Demands' => function($e){
            return $e->select('id','consolidated_demand_id')->withCount('CommitDemandTransactions')->get();
        }])
        ->withCount('Demands')
        ->with('Crop')
        ->where('date', $date);
    }
}