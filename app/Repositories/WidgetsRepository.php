<?php

namespace App\Repositories;

use App\Interfaces\WidgetsRepositoryInterface;
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
use stdClass;
use Carbon\Carbon;

class WidgetsRepository implements WidgetsRepositoryInterface  
{
    public function demandOverCommitments(){

        $data = new stdClass;
        $demands = new stdClass;
        $receivables = 0;
        $commits = new stdClass;
        $payables = 0;

        // for all the pooling and closed demands status as of current year base on created_at for count
        $consolidated_demands = DB::table('consolidated_demands')
        ->where(function ($query){
            $query->where('status', 'pooling');
            $query->orWhere('status', 'closed');
        })
        ->whereYear('consolidated_demands.created_at', date('Y'))
        ->get();
        $demands->count = count($consolidated_demands);

        // for receivables
        for ($i=0; $i < count($consolidated_demands) ; $i++) { 
            $receivables += $consolidated_demands[$i]->consolidated_amount;
        }

        $demands->receivables = $receivables;
        // return $demands;

        // for all the unpaid but approved commits 
        $commit_demand_transactions = DB::table('commit_demand_transactions')
        ->join('mapped_transactions', 'mapped_transactions.id', '=', 'commit_demand_transactions.mapped_transaction_id')
        ->where(function ($query){
            $query->where('mapped_transactions.status','pending');
            $query->whereYear('commit_demand_transactions.created_at', date('Y'));
        })->get();

        $commits->count = count($commit_demand_transactions);

        // for payables
        for ($i=0; $i < count($commit_demand_transactions) ; $i++) { 
            $payables += $commit_demand_transactions[$i]->amount;
        }

        $commits->payables = $payables;

        $data->demands = $demands;
        $data->commits = $commits;
        return $data;


    }

    // return the count of accounts (farmer & trader)
    public function accounts(){
        
        $data = new stdClass;
        $new_accounts = new stdClass;
        $verified_accounts = new stdClass;

        // new farmer accounts
        $new_farmer = count(DB::table('users')
        ->where(function ($query){
            $query->where('user_type', 'farmer');
            $query->where('status', 'pending');
        })->get());

        // new trader accounts
        $new_trader = count(DB::table('users')
        ->where(function ($query){
            $query->where('user_type', 'trader');
            $query->where('status', 'pending');
        })->get());
        
        $new_accounts->count = $new_farmer + $new_trader;
        $new_accounts->farmers = $new_farmer;
        $new_accounts->traders = $new_trader;

        // verified farmer accounts
        $verified_farmer = count(DB::table('users')
        ->where(function ($query){
            $query->where('users.user_type', 'farmer');
            $query->where('users.status', 'approved');
        })->get());

        $verified_trader = count(DB::table('users')
        ->where(function ($query){
            $query->where('users.user_type', 'trader');
            $query->where('users.status', 'approved');
        })->get());

        $verified_accounts->count = $verified_farmer + $verified_trader;
        $verified_accounts->farmer = $verified_farmer;
        $verified_accounts->trader = $verified_trader;

        $data->verified_accounts = $verified_accounts;
        $data->new_accounts = $new_accounts;

        return $data;
        
    }

    public function priceTrend(){

    }

    // return the status per crop in inventory
    public function inventory(){
        $inventory = new stdClass;
        $shelves = DB::table('agrihub_shelves')
        ->join('deposit_transactions', 'deposit_transactions.id', '=', 'agrihub_shelves.deposit_transaction_id')
        ->join('admin_farmer_requests', 'admin_farmer_requests.id', '=', 'deposit_transactions.admin_farmer_request_id')
        ->join('crops', 'crops.id', '=', 'admin_farmer_requests.crop_id')
        ->select('crops.name as crop_name', 'agrihub_shelves.salable_until as salable_until', 'agrihub_shelves.qty as quantity', 'agrihub_shelves.remaining_qty as remaining_quantity')
        ->get();
        $inventory->shelves = $shelves;

        return $inventory;
    }

    public function sales(){
        
    }

    public function priceIndex(){

    }

}
