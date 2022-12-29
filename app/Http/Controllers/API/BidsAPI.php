<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bids;
use Illuminate\Http\Request;

use App\Models\Consolidated_Demands;
use App\Models\Crops;
use App\Models\Demands;
use App\Models\Planting_Plan;
use App\Models\Planting_Plan_Images;
use Dotenv\Validator;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidsAPI extends Controller
{
    public function bid_to_demands(Request $request)
    {
        ob_start('ob_gzhandler');
        DB::beginTransaction();
            try {
                // Insert to Bids
                $demand = Demands::with('crops.crop_pricing')->where('id', $request->fk_consolidated_demands_id)->get();
                
                $date_append_to_tracking_number = Carbon::now()->format('Y').''.Carbon::now()->format('m').''.Carbon::now()->format('d');
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $str_random1 = substr(str_shuffle(str_repeat($pool, 5)), 0, 7);
                $tracking_number = $date_append_to_tracking_number.'-'.$str_random1;

                // Insert to Planing Plan
                $pplan = new Planting_Plan();
                $pplan->fk_consolidated_demands_id = $request->fk_consolidated_demands_id;
                $pplan->farm_size = $request->farm_size;
                $pplan->no_of_hills = $request->no_of_hills;
                $pplan->sowing_date = $request->sowing_date;
                $pplan->transplanting_date = $request->transplanting_date;
                $pplan->seed_provider = $request->seed_provider;
                $pplan->fk_users_acc_id = $request->fk_users_acc_id;
                $pplan->save();

                $bids = new Bids();
                $bids->fk_consolidated_demands_id = $request->fk_consolidated_demands_id;
                $bids->fk_users_acc_id = $request->fk_users_acc_id;
                $bids->qty = $request->qty;
                $bids->amount_receivable = $demand[0]->crops[0]->crop_pricing->fgp * $request->qty;
                $bids->tracking_number = $tracking_number;
                $bids->fk_planting_plan_id = $pplan->id;
                $bids->save();
                
                // $total_remaining_qty = Consolidated_Demands::where('id', $request->fk_consolidated_demands_id)->get();
                // $rem_qty = ($total_remaining_qty[0]->total_remaining_qty - $request->qty);
                // Consolidated_Demands::where('id', $request->fk_consolidated_demands_id)->update([ 'total_remaining_qty' =>  $rem_qty]);
                
                // Get all Demands
                $for_update_demands = Demands::where('fk_consolidated_demands_id', $request->fk_consolidated_demands_id)->get();
                foreach ($for_update_demands as $key) {
                    // Update status
                    // If 48hrs or If naa nay nag bid
                    Demands::where('fk_consolidated_demands_id', $key->fk_consolidated_demands_id)->update([ 'status' =>  "On-Process"]);
                }
                
                // if($rem_qty == 0){
                //     Consolidated_Demands::where('id', $request->fk_consolidated_demands_id)->update([ 'status' =>  "On-Process"]);
                // }
            
            DB::commit();
            return response([
                'message' => "Committed Successfully",
                'Commiment_Tracking_Number' => $tracking_number,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 401);
        }
        ob_end_flush();

    }

    public function view_bid_to_demands(Request $request)
    {
        // {
        //     "user_id": "1"
        // }
        return Bids::with('consolidated_demands.crops.crop_pricing')->where("fk_users_acc_id", $request->user_id)->get();
    }

    public function add_progress(Request $request){
        // return $request;
        // long_string - Base 64 image
        ob_start('ob_gzhandler');
        DB::beginTransaction();
            try {
                // Planting_Plan::where('id', $request->fk_planting_plan_id)->update(['planting_plan_photos' => $request->image]);
                $Planting_Plan = new Planting_Plan_Images();
                $Planting_Plan->fk_planting_plan_id = $request->fk_planting_plan_id;
                $Planting_Plan->filename = $request->image;
                $Planting_Plan->save();

                DB::commit();
                return response([
                    'message' => "Added Progress Report Successfully",
                ], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response(['message' => $e->getMessage()], 401);
            }
        ob_end_flush();
    }

    public function view_progress(Request $request){
        // return $request;
        // long_string - Base 64 image
        ob_start('ob_gzhandler');
            return Planting_Plan_Images::where('fk_planting_plan_id', $request->fk_planting_plan_id)->get();
        ob_end_flush();
    }

    public function uploadImage(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        // if ($validator->fails()) {
        //     return response([
        //         'message' => $validator->messages()->first(),
        //     ], 500);
        // }

        // $uploadFolder = 'users';
        // $image = $request->file('image');
        // $image_uploaded_path = $image->store($uploadFolder, 'public');
        // $uploadedImageResponse = array(
        //     "image_name" => basename($image_uploaded_path),
        //     "image_url" => Storage::disk('public')-  >url($image_uploaded_path),
        //     "mime" => $image->getClientMimeType()
        // );
        // return response([
        //     'File Uploaded Successfully' => $validator->messages()->first(),
        // ], 500);
        // return sendCustomResponse('File Uploaded Successfully', 'success',   200, $uploadedImageResponse);
    }

    public function bid_recommendation(Request $request){
        $RESPONSE_FARMSIZE_NO_OF_HILLS = [];
        $RESPONSE_DATA = [];

        $farm_size = $request->farm_size;
        $default_farm_size = $request->default_farm_size;
        $Days_in_a_Week = 7;

        // $crop = Crops::with('crop_pricing')->with('crop_production_model')->with('crop_production_harvesting_model')->where('id', $request->crop_id)->first();
        $crop = Crops::with('crop_pricing')->with('crop_production_model')->with('crop_production_harvesting_model')->where('id', $request->crop_id)->first();

        $delivery_date = new Carbon($request->delivery_date);
        $RECOMMENDED_PLANTING_DATE = [];

        // Plantig Date and Maturity Date
        $subtrahend_Days = $crop->crop_production_model->maturity_to+1;
        $planting_date = $delivery_date->subDays($subtrahend_Days);
        $planting_date_for_array = clone $planting_date->addDay();;
        
        for($i = 1; $i <= 6; $i++)
        {
            $date = '';
            $date = $planting_date_for_array->subDays(1);
    
            $RECOMMENDED_PLANTING_DATE[] = $date->format('Y-m-j');
        }


        $planting_date_carbon_parsed = new Carbon($RECOMMENDED_PLANTING_DATE[4]);
        // $planting_date_carbon_parsed = new Carbon($planting_date);
        $planting_date_carbon_parsed_and_fortmatted = $planting_date_carbon_parsed->format('Y-m-d');

        $planting_date_carbon_parsed_for_calc = clone $planting_date_carbon_parsed;

        
        $harvesting_period_no_if_weeks = $crop->crop_production_harvesting_model->count();
        $harvesting_period_no_if_days = $harvesting_period_no_if_weeks*$Days_in_a_Week;

        $START_OF_HARVEST = $planting_date_carbon_parsed_for_calc->addDays($crop->crop_production_model->maturity_to);
        
        $start_of_harvest_for_calc = clone $START_OF_HARVEST;
        
        $END_OF_HARVEST = $start_of_harvest_for_calc->addDays($harvesting_period_no_if_days);

        $period = CarbonPeriod::create($START_OF_HARVEST->format('Y-m-d'), $END_OF_HARVEST->format('Y-m-d'), CarbonPeriod::EXCLUDE_START_DATE);
        $period_array = $period->toArray();


        $HARVEST_WEEKS = array_chunk($period->toArray(), 7);
        
        // VARIABLES
        $CONSTANT_DIVISOR = 1000;
        $DEFAULT_HILLS = $crop->crop_production_model->qty_hills;
        $FREQUENCY_WEEKLY_HARVESTING = intval($crop->crop_production_model->harvesting);

        // CALCULATION
        $farm_size_x_Constant = $farm_size / $CONSTANT_DIVISOR;
        $Official_Hills = $farm_size_x_Constant * $DEFAULT_HILLS;

        array_push($RESPONSE_FARMSIZE_NO_OF_HILLS, (object)[
            "Remaining_FarmSize" => $default_farm_size - $farm_size,
            "No_of_Hills" => $Official_Hills,
            "Recommended_Planting_Date" => $RECOMMENDED_PLANTING_DATE
        ]);

        $week_arr = [];
        $crop_production_harvesting_model_count = $crop->crop_production_harvesting_model->count();

        for ($i=0; $i < $crop_production_harvesting_model_count; $i++) { 
            # code...
            $hills_x_weekly_value_multiplier = $Official_Hills * $crop->crop_production_harvesting_model[$i]->value;

            if($FREQUENCY_WEEKLY_HARVESTING > 0){
                $EXPECTED_HARVESTED_CROPS = $hills_x_weekly_value_multiplier / $FREQUENCY_WEEKLY_HARVESTING;
                array_push($RESPONSE_DATA, (object)[
                    "Week" =>  $i+1,
                    "Date_from" => reset($HARVEST_WEEKS[$i])->format('Y-m-d'),
                    "Date_To" => end($HARVEST_WEEKS[$i])->format('Y-m-d'),
                    "Expected_Harvest" => $EXPECTED_HARVESTED_CROPS,
                ]);
            }
        }

        return response([
            'farmsize_no_of_hills' => $RESPONSE_FARMSIZE_NO_OF_HILLS,
            'weekly_harvest' => $RESPONSE_DATA,
        ], 200);
    }
}
