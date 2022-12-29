<?php

namespace App\Repositories;

use App\Interfaces\SalesAndTransactionsInterface;
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
use Illuminate\Support\Facades\Auth;

class SalesAndTransactionsRepository implements SalesAndTransactionsInterface 
{
    public function getAllMappedTransactionsDemandsWithCommits() 
    {   
        return MappedTransaction::with('Demands.ConsolidatedDemands')->with('Demands.Crop.CropPricing');
    }
    
    public function getSpecificMappedTransactionsDemandsWithCommits($id) 
    {   
        return MappedTransaction::with('Demands.ConsolidatedDemands')->with('Demands.Crop.CropPricing')->where('id', $id);
    }
    

    public function getClientData($id) 
    {   
        return User::with('UserDetail.BusinessDetail')->where('id', $id);
    }

    public function searchDemands($params) 
    {
        // return
    }

    public function getPaymentHistory($mapped_transation_id) 
    {
        return MappedTransaction::with('PaymentHistory')
        ->with('Demands.Crop.CropPricing')
        ->with(['UserDetail.User' => function($query){
            return $query->select('id', 'email')->get();
        }])
        ->where('id',$mapped_transation_id);
    }

    public function getCommitsViaDemandID($consolidated_demand_id) 
    {
        return Commit::with('Farmer')->with('CommitDemandTransactions')->where('consolidated_demand_id',$consolidated_demand_id);
    }

    public function demandsWithCommitsViaConsolidatedDemandID($consolidated_demand_id)
    {
        return Demand::with('Trader')->where('consolidated_demand_id',$consolidated_demand_id);
    }

    public function createCommit($commit_qty) 
    {

    }

    public function approveCommit($commit_id, $demand_id, $demands_array) 
    {
        $resultArr = [];
        $commit = Commit::where('id', $commit_id)->get();
        
        $commited_qty_array = [];
        $approved_qty_array = [];

        $commit_qty_holder = $commit[0]->qty;
        $current_demand_remaining_qty = 0;

        for ($i=0; $i < count($demands_array); $i++) {
            // filter if params: $demand_id is not equal to $demands_array[$i]
            $current_demand = Demand::where('id', $demands_array[$i])->get();
            $pricing = CropPricing::where('crop_id', $current_demand[0]->crop_id)->get();

            // Conditionals
            if($commit_qty_holder > $current_demand[0]->remaining_qty){

                
                // Subtract commit to remaining qty
                $commit_subtract_demand_result = $commit_qty_holder - $current_demand[0]->remaining_qty;
                $amount_receivable = $pricing[0]->fgp * $current_demand[0]->remaining_qty;

                if($current_demand[0]->remaining_qty == 0){
                    continue;
                }

                // Assign remaining balance = 0, 
                Demand::where('id', $demands_array[$i])->update(['remaining_qty' => 0]);
                // Set/Update amount_receivable column
                Commit::where('id', $commit_id)->update(['amount_receivable' => $amount_receivable,'status' => 'approved']);

                # Mapped Transaction
                $count = DB::table('mapped_transactions')->count();
                $count_record = 0;
                $mapped_increment = 0;
                
                //check the record count for increments in mapped_transactions.transaction_no
                if ($count == 0) {
                    $mapped_increment = $count_record + 1;
                }
                else{
                    $last_mapped_id = DB::table('mapped_transactions')->orderBy('id', 'DESC')->first()->id;
                    $mapped_increment = $last_mapped_id + 1;
                }

                //add new mapped_transaction in every checkout
                $mapped_transaction = new MappedTransaction();
                $mapped_transaction->user_id = Auth::user()->id;
                $mapped_transaction->transaction_no = "BXU-CMT-".$commit[0]->user_id."-".$current_demand[0]->user_id."-".str_pad($mapped_increment,4,0,STR_PAD_LEFT);
                $mapped_transaction->transaction_type = "commit";
                $mapped_transaction->amount = $amount_receivable;
                $mapped_transaction->save();

                $commit_demand_transaction = new CommitDemandTransaction();
                $commit_demand_transaction->demand_id = $current_demand[0]->id;
                $commit_demand_transaction->commit_id = $commit[0]->id;
                $commit_demand_transaction->mapped_transaction_id = $mapped_transaction->id;
                $commit_demand_transaction->approved_qty = $current_demand[0]->remaining_qty;
                $commit_demand_transaction->amount = $amount_receivable;
                $commit_demand_transaction->save();
                
                // Push to approved qty array
                array_push($approved_qty_array, $current_demand[0]->remaining_qty);

                array_push($resultArr, "Greater than" . '- Demand ID -'. $demands_array[$i].' commit qrt holder -'. $commit_qty_holder .' current_demand-remaining_qty -'. $current_demand[0]->remaining_qty);
                // Re-assign value of commit for any balance
                $commit_qty_holder = $commit_subtract_demand_result;

                // Push to balance Array
                array_push($commited_qty_array, $current_demand[0]->remaining_qty);
            }else if($current_demand[0]->remaining_qty > $commit_qty_holder){

                // Subtract remaining qty to commit
                $demand_subtract_commit_result = $current_demand[0]->remaining_qty - $commit_qty_holder;
                $amount_receivable = $pricing[0]->fgp * $demand_subtract_commit_result;

                // Push to balance Array
                array_push($commited_qty_array, $commit_qty_holder);

                // Assign remaining balance = demand_subtract_commit_result, 
                Demand::where('id', $demands_array[$i])->update(['remaining_qty' => $demand_subtract_commit_result]);
                // Set/Update amount_receivable column
                Commit::where('id', $commit_id)->update(['amount_receivable' => $amount_receivable,'status' => 'approved']);
                
                # Mapped Transaction
                $count = DB::table('mapped_transactions')->count();
                $count_record = 0;
                $mapped_increment = 0;
                
                //check the record count for increments in mapped_transactions.transaction_no
                if ($count == 0) {
                    $mapped_increment = $count_record + 1;
                }
                else{
                    $last_mapped_id = DB::table('mapped_transactions')->orderBy('id', 'DESC')->first()->id;
                    $mapped_increment = $last_mapped_id + 1;
                }

                //add new mapped_transaction in every checkout
                $mapped_transaction = new MappedTransaction();
                $mapped_transaction->user_id = Auth::user()->id;
                $mapped_transaction->transaction_no = "BXU-CMT-".$commit[0]->user_id."-".$current_demand[0]->user_id."-".str_pad($mapped_increment,4,0,STR_PAD_LEFT);
                $mapped_transaction->transaction_type = "commit";
                $mapped_transaction->amount = $amount_receivable;
                $mapped_transaction->save();

                $commit_demand_transaction = new CommitDemandTransaction();
                $commit_demand_transaction->demand_id = $current_demand[0]->id;
                $commit_demand_transaction->commit_id = $commit[0]->id;
                $commit_demand_transaction->mapped_transaction_id = $mapped_transaction->id;
                $commit_demand_transaction->approved_qty = $commit_qty_holder;
                $commit_demand_transaction->amount = $amount_receivable;
                $commit_demand_transaction->save();

                // Push to approved qty array
                array_push($approved_qty_array, $commit_qty_holder);

                // Checker if 
                array_push($resultArr, "Less than" . '- Demand ID -'. $demands_array[$i] .' commit qrt holder -'. $commit_qty_holder .' current_demand-remaining_qty -'. $current_demand[0]->remaining_qty);
                // Re-assign value of commit for any balance
                $commit_qty_holder = $demand_subtract_commit_result;

                break;

            }else if($current_demand[0]->remaining_qty === $commit_qty_holder){

                Demand::where('id', $demands_array[$i])->update(['remaining_qty' => 0]);
                $amount_receivable = $pricing[0]->fgp * $current_demand[0]->remaining_qty;

                # Mapped Transaction
                $count = DB::table('mapped_transactions')->count();
                $count_record = 0;
                $mapped_increment = 0;
                
                //check the record count for increments in mapped_transactions.transaction_no
                if ($count == 0) {
                    $mapped_increment = $count_record + 1;
                }
                else{
                    $last_mapped_id = DB::table('mapped_transactions')->orderBy('id', 'DESC')->first()->id;
                    $mapped_increment = $last_mapped_id + 1;
                }

                //add new mapped_transaction in every checkout
                $mapped_transaction = new MappedTransaction();
                $mapped_transaction->user_id = Auth::user()->id;
                $mapped_transaction->transaction_no = "BXU-CMT-".$commit[0]->user_id."-".$current_demand[0]->user_id."-".str_pad($mapped_increment,4,0,STR_PAD_LEFT);
                $mapped_transaction->transaction_type = "commit";
                $mapped_transaction->amount = $amount_receivable;
                $mapped_transaction->save();

                $commit_demand_transaction = new CommitDemandTransaction();
                $commit_demand_transaction->demand_id = $current_demand[0]->id;
                $commit_demand_transaction->commit_id = $commit[0]->id;
                $commit_demand_transaction->mapped_transaction_id = $mapped_transaction->id;
                $commit_demand_transaction->approved_qty = $commit_qty_holder;
                $commit_demand_transaction->amount = $amount_receivable;
                $commit_demand_transaction->save();

                array_push($resultArr, "Equal na" . '- Demand ID -'. $demands_array[$i] .' commit qrt holder -'. $commit_qty_holder .' current_demand-remaining_qty -'. $current_demand[0]->remaining_qty);
                
                array_push($commited_qty_array, $commit_qty_holder);
                break;

            }else{
                break;
            }

            // return $commit_qty_constant;
            // return $demands_array[$i];

        }
        
        $balance = $commit[0]->qty - array_sum($approved_qty_array);
        Commit::where('id', $commit_id)->update(['excess_qty' => $balance]);

        return 1;
    }
    

    public function disApproveCommit($commit_id) 
    {
        // Set/Update status column to disapproved
        if(Commit::where('id', $commit_id)->update(['status' => 'disapproved'])){
            return 1;
        }else{
            return 0;
        }
    }
}
