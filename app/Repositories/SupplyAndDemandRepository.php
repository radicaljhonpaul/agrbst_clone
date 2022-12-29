<?php

namespace App\Repositories;

use App\Interfaces\SupplyAndDemandInterface;
use App\Interfaces\UserAccountsInterface;
use App\Models\Commit;
use App\Models\CommitDemandTransaction;
use App\Models\ConsolidatedDemand;
use App\Models\CropPricing;
use App\Models\CropProduction;
use App\Models\CropProductionHarvestingModel;
use App\Models\User;
use App\Models\Demand;
use App\Models\HarvestData;
use App\Models\HarvestFrequencies;
use App\Models\MappedTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class SupplyAndDemandRepository implements SupplyAndDemandInterface 
{
    
    public function getAllConsolidatedDemandsWithCommits() 
    {   
        return ConsolidatedDemand::with(['Demands' => function($e){
            return $e->select('id','consolidated_demand_id')->withCount('CommitDemandTransactions')->get();
        }])
        ->withCount('Demands')
        ->with('Crop');
    }
    
    public function searchDemands($params) 
    {
        // return
    }

    public function specificConsolidatedDemand($consolidated_demand_id) 
    {
        return ConsolidatedDemand::with('Crop')->with('CropPricing')->where('id',$consolidated_demand_id);
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
        DB::beginTransaction();
        try {
            
            $resultArr = [];
            $commit = Commit::where('id', $commit_id)->get();
            
            $commited_qty_array = [];
            $approved_qty_array = [];

            $commit_qty_holder = $commit[0]->qty;
            $current_demand_remaining_qty = 0;

            $crop_maturity = 0;

            for ($i=0; $i < count($demands_array); $i++) {
                // filter if params: $demand_id is not equal to $demands_array[$i]
                $current_demand = Demand::where('id', $demands_array[$i])->get();
                $pricing = CropPricing::where('crop_id', $current_demand[0]->crop_id)->get();

                // query in crops - to check if a crop is successive or not.
                $crop = DB::table('crops')->where('crops.id', $current_demand[0]->crop_id)->get();

                // Conditionals
                if($commit_qty_holder > $current_demand[0]->remaining_qty){
                    // Subtract commit to remaining qty
                    $commit_subtract_demand_result = $commit_qty_holder - $current_demand[0]->remaining_qty;
                    $amount_receivable = $pricing[0]->fgp * $current_demand[0]->remaining_qty;

                    if($current_demand[0]->remaining_qty == 0){
                        continue;
                    }

                    // Assign remaining balance = 0, 
                    Demand::where('id', $demands_array[$i])->update(['remaining_qty' => 0, 'status' => 'closed']);
                    // Set/Update amount_receivable column
                    Commit::where('id', $commit_id)->update(['status' => 'approved']);

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
                    $mapped_transaction->transaction_no = "BXU-CMT-".$commit[0]->user_id."-".$current_demand[0]->user_id."-".str_pad($mapped_increment,4,0,STR_PAD_LEFT);
                    $mapped_transaction->transaction_type = "commit";
                    $mapped_transaction->amount = $amount_receivable;
                    $mapped_transaction->save();
                    
                    $commit_demand_transaction = new CommitDemandTransaction();
                    $commit_demand_transaction->demand_id = $current_demand[0]->id;
                    $commit_demand_transaction->commit_id = $commit[0]->id;
                    $commit_demand_transaction->mapped_transaction_id = $mapped_transaction->id;
                    $commit_demand_transaction->approved_qty = $current_demand[0]->remaining_qty;
                    $commit_demand_transaction->amount_receivable = $amount_receivable;
                    $commit_demand_transaction->save();
                    
                    // if crop is successive, save to harvest datass
                    if ($crop[0]->successive == 1) {

                        $crop_production_harvesting_model = CropProductionHarvestingModel::where('crop_id', $crop[0]->id)->get();
                        $crop_production = CropProduction::where('crop_id', $crop[0]->id)->get();

                        // Constant Variables
                        $farm_size_constant = 1000;
                        $HarvestWeekLength = $crop[0]->no_of_weeks;

                        // Official Hills of Crop
                        $default_hills_per_crop = $crop_production[0]->qty_hills;

                        // CommitDetails
                        $commit_details = Commit::where('id', $commit_id)->get();
                        $committed_farm_size = $commit_details[0]->commited_farm_size;
                        
                        // Date Variables
                        $days_in_a_week = 7;
                        $prep_time_days = 7;

                        $delivery_date = Carbon::parse($current_demand[0]->date);
                        $subtrahend = $crop_production[0]->maturity_to + $prep_time_days;
                        
                        $planting_date = $delivery_date->subDays($subtrahend);
                        
                        // Date
                        $start_of_harvest = $planting_date->addDays($crop_production[0]->maturity_to);
                        $start_of_harvest_calculation = clone $start_of_harvest;
                        $end_of_harvest = $start_of_harvest->addDays($HarvestWeekLength * $days_in_a_week);
                        
                        $periodWeekly = CarbonPeriod::create($start_of_harvest_calculation->format('Y-m-d'), $end_of_harvest->format('Y-m-d'), CarbonPeriod::EXCLUDE_START_DATE);
                        $periodWeeklyArray = array_chunk($periodWeekly->toArray(), 7);

                        // Save Harvest Data
                        $harvest_data = new HarvestData();
                        $harvest_data->crop_id = $crop[0]->id;
                        $harvest_data->commit_demand_transaction_id = $commit_demand_transaction->id;
                        $harvest_data->harvest_data_type = "commit";
                        $harvest_data->planting_date = Carbon::parse($current_demand[0]->date)->subDays($crop_maturity)->format('Y/m/d');
                        $harvest_data->no_of_weeks = $HarvestWeekLength;
                        $harvest_data->save();

                        // Loop for crops->no_of_weeks
                        for($x=0; $x < $HarvestWeekLength; $x++) { 
                            $counter = 1;
                            // Result of (CommittedFarmSize / FarmSizeConstant)
                            $committed_farm_size_devided_by_farm_size_constant = $committed_farm_size / $farm_size_constant;
    
                            // Official Hills
                            $official_hills = $committed_farm_size_devided_by_farm_size_constant * $default_hills_per_crop;

                            // Harvesting
                            $expected_harvest = $official_hills * $crop_production_harvesting_model[$i]->value;

                            $harvest_frequencies = new HarvestFrequencies();
                            $harvest_frequencies->harvest_data_id = $harvest_data->id;
                            $harvest_frequencies->week_no = $counter + $x;
                            $harvest_frequencies->harvest_date_from = $periodWeeklyArray[$x][0]->format('Y-m-d');
                            $harvest_frequencies->harvest_date_to = $periodWeeklyArray[$x][6]->format('Y-m-d');
                            $harvest_frequencies->forcasted_harvest_qty = $expected_harvest;
                            $harvest_frequencies->save();
                            
                        }

                    }
                    
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
                    Commit::where('id', $commit_id)->update(['status' => 'approved']);
                    
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
                    $mapped_transaction->transaction_no = "BXU-CMT-".$commit[0]->user_id."-".$current_demand[0]->user_id."-".str_pad($mapped_increment,4,0,STR_PAD_LEFT);
                    $mapped_transaction->transaction_type = "commit";
                    $mapped_transaction->amount = $amount_receivable;
                    $mapped_transaction->save();
                    
                    $commit_demand_transaction = new CommitDemandTransaction();
                    $commit_demand_transaction->demand_id = $current_demand[0]->id;
                    $commit_demand_transaction->commit_id = $commit[0]->id;
                    $commit_demand_transaction->mapped_transaction_id = $mapped_transaction->id;
                    $commit_demand_transaction->approved_qty = $commit_qty_holder;
                    $commit_demand_transaction->amount_receivable = $amount_receivable;
                    $commit_demand_transaction->save();
                    
                    // if crop is successive, save to harvest datass
                    if ($crop[0]->successive == 1) {
                        
                        $crop_production_harvesting_model = CropProductionHarvestingModel::where('crop_id', $crop[0]->id)->get();
                        $crop_production = CropProduction::where('crop_id', $crop[0]->id)->get();

                        // Constant Variables
                        $farm_size_constant = 1000;
                        $HarvestWeekLength = $crop[0]->no_of_weeks;

                        // Official Hills of Crop
                        $default_hills_per_crop = $crop_production[0]->qty_hills;

                        // CommitDetails
                        $commit_details = Commit::where('id', $commit_id)->get();
                        $committed_farm_size = $commit_details[0]->commited_farm_size;
                        
                        // Date Variables
                        $days_in_a_week = 7;
                        $prep_time_days = 7;

                        $delivery_date = Carbon::parse($current_demand[0]->date);
                        $subtrahend = $crop_production[0]->maturity_to + $prep_time_days;
                        
                        $planting_date = $delivery_date->subDays($subtrahend);
                        
                        // Date
                        $start_of_harvest = $planting_date->addDays($crop_production[0]->maturity_to);
                        $start_of_harvest_calculation = clone $start_of_harvest;
                        $end_of_harvest = $start_of_harvest->addDays($HarvestWeekLength * $days_in_a_week);
                        
                        $periodWeekly = CarbonPeriod::create($start_of_harvest_calculation->format('Y-m-d'), $end_of_harvest->format('Y-m-d'), CarbonPeriod::EXCLUDE_START_DATE);
                        $periodWeeklyArray = array_chunk($periodWeekly->toArray(), 7);
                        
                        // Save Harvest Data
                        $harvest_data = new HarvestData();
                        $harvest_data->crop_id = $crop[0]->id;
                        $harvest_data->commit_demand_transaction_id = $commit_demand_transaction->id;
                        $harvest_data->harvest_data_type = "commit";
                        $harvest_data->planting_date = Carbon::parse($current_demand[0]->date)->subDays($crop_maturity)->format('Y/m/d');
                        $harvest_data->no_of_weeks = $HarvestWeekLength;
                        $harvest_data->save();

                        // Loop for crops->no_of_weeks
                        for($x=0; $x < $HarvestWeekLength; $x++) { 
                            $counter = 1;
                            // Result of (CommittedFarmSize / FarmSizeConstant)
                            $committed_farm_size_devided_by_farm_size_constant = $committed_farm_size / $farm_size_constant;
    
                            // Official Hills
                            $official_hills = $committed_farm_size_devided_by_farm_size_constant * $default_hills_per_crop;

                            // Harvesting
                            $expected_harvest = $official_hills * $crop_production_harvesting_model[$i]->value;

                            $harvest_frequencies = new HarvestFrequencies();
                            $harvest_frequencies->harvest_data_id = $harvest_data->id;
                            $harvest_frequencies->week_no = $counter + $x;
                            $harvest_frequencies->harvest_date_from = $periodWeeklyArray[$x][0]->format('Y-m-d');
                            $harvest_frequencies->harvest_date_to = $periodWeeklyArray[$x][6]->format('Y-m-d');
                            $harvest_frequencies->forcasted_harvest_qty = $expected_harvest;
                            $harvest_frequencies->save();
                            
                        }

                    }
                    
                    // Push to approved qty array
                    array_push($approved_qty_array, $commit_qty_holder);
                    // Checker if 
                    // return $demands_array;
                    array_push($resultArr, "Less than" . '- Demand ID -'. $demands_array[$i] .' commit qrt holder -'. $commit_qty_holder .' current_demand-remaining_qty -'. $current_demand[0]->remaining_qty);
                    // Re-assign value of commit for any balance
                    $commit_qty_holder = $demand_subtract_commit_result;
                    

                    break;

                }else if($current_demand[0]->remaining_qty === $commit_qty_holder){ 

                    Demand::where('id', $demands_array[$i])->update(['remaining_qty' => 0]);
                    $amount_receivable = $pricing[0]->fgp * $current_demand[0]->remaining_qty;

                    // Set/Update amount_receivable column
                    Commit::where('id', $commit_id)->update(['status' => 'approved']);

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
                    $mapped_transaction->transaction_no = "BXU-CMT-".$commit[0]->user_id."-".$current_demand[0]->user_id."-".str_pad($mapped_increment,4,0,STR_PAD_LEFT);
                    $mapped_transaction->transaction_type = "commit";
                    $mapped_transaction->amount = $amount_receivable;
                    $mapped_transaction->save();

                    $commit_demand_transaction = new CommitDemandTransaction();
                    $commit_demand_transaction->demand_id = $current_demand[0]->id;
                    $commit_demand_transaction->commit_id = $commit[0]->id;
                    $commit_demand_transaction->mapped_transaction_id = $mapped_transaction->id;
                    $commit_demand_transaction->approved_qty = $commit_qty_holder;
                    $commit_demand_transaction->amount_receivable = $amount_receivable;
                    $commit_demand_transaction->save();

                    array_push($resultArr, "Equal na" . '- Demand ID -'. $demands_array[$i] .' commit qrt holder -'. $commit_qty_holder .' current_demand-remaining_qty -'. $current_demand[0]->remaining_qty);
                    
                    // if crop is successive, save to harvest datass
                    if ($crop[0]->successive == 1) {

                        $crop_production_harvesting_model = CropProductionHarvestingModel::where('crop_id', $crop[0]->id)->get();
                        $crop_production = CropProduction::where('crop_id', $crop[0]->id)->get();

                        // Constant Variables
                        $farm_size_constant = 1000;
                        $HarvestWeekLength = $crop[0]->no_of_weeks;

                        // Official Hills of Crop
                        $default_hills_per_crop = $crop_production[0]->qty_hills;

                        // CommitDetails
                        $commit_details = Commit::where('id', $commit_id)->get();
                        $committed_farm_size = $commit_details[0]->commited_farm_size;
                        
                        // Date Variables
                        $days_in_a_week = 7;
                        $prep_time_days = 7;

                        $delivery_date = Carbon::parse($current_demand[0]->date);
                        $subtrahend = $crop_production[0]->maturity_to + $prep_time_days;
                        
                        $planting_date = $delivery_date->subDays($subtrahend);
                        
                        // Date
                        $start_of_harvest = $planting_date->addDays($crop_production[0]->maturity_to);
                        $start_of_harvest_calculation = clone $start_of_harvest;
                        $end_of_harvest = $start_of_harvest->addDays($HarvestWeekLength * $days_in_a_week);
                        
                        $periodWeekly = CarbonPeriod::create($start_of_harvest_calculation->format('Y-m-d'), $end_of_harvest->format('Y-m-d'), CarbonPeriod::EXCLUDE_START_DATE);
                        $periodWeeklyArray = array_chunk($periodWeekly->toArray(), 7);

                        // Save Harvest Data
                        $harvest_data = new HarvestData();
                        $harvest_data->crop_id = $crop[0]->id;
                        $harvest_data->commit_demand_transaction_id = $commit_demand_transaction->id;
                        $harvest_data->harvest_data_type = "commit";
                        $harvest_data->planting_date = Carbon::parse($current_demand[0]->date)->subDays($crop_maturity)->format('Y/m/d');
                        $harvest_data->no_of_weeks = $HarvestWeekLength;
                        $harvest_data->save();

                        // Loop for crops->no_of_weeks
                        for($x=0; $x < $HarvestWeekLength; $x++) { 
                            $counter = 1;
                            // Result of (CommittedFarmSize / FarmSizeConstant)
                            $committed_farm_size_devided_by_farm_size_constant = $committed_farm_size / $farm_size_constant;
    
                            // Official Hills
                            $official_hills = $committed_farm_size_devided_by_farm_size_constant * $default_hills_per_crop;

                            // Harvesting
                            $expected_harvest = $official_hills * $crop_production_harvesting_model[$i]->value;

                            $harvest_frequencies = new HarvestFrequencies();
                            $harvest_frequencies->harvest_data_id = $harvest_data->id;
                            $harvest_frequencies->week_no = $counter + $x;
                            $harvest_frequencies->harvest_date_from = $periodWeeklyArray[$x][0]->format('Y-m-d');
                            $harvest_frequencies->harvest_date_to = $periodWeeklyArray[$x][6]->format('Y-m-d');
                            $harvest_frequencies->forcasted_harvest_qty = $expected_harvest;
                            $harvest_frequencies->save();
                        }

                    }

                    array_push($commited_qty_array, $commit_qty_holder);
                    break;

                }else{
                    break;
                }

                // return $commit_qty_constant;
                // return $demands_array[$i];

            }
            if (array_sum($approved_qty_array)=== 0) {
                $balance = 0;
            }
            else{
                $balance = $commit[0]->qty - array_sum($approved_qty_array);
            }
            // return $balance;
            Commit::where('id', $commit_id)->update(['excess_qty' => $balance]);

            DB::commit();
            return 1;
        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 401);
        }
        
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

    public function getCalendarView($month) 
    {
        return $this->getAllConsolidatedDemandsWithCommits()->whereMonth('date', $month)->get();
    }
    
}
