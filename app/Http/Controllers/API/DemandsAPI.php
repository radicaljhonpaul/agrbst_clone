<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Batch_Checked_Out;
use App\Models\Consolidated_Demands;
use App\Models\Bids;
use App\Models\Checked_Out_Demands;
use App\Models\Crop_Pricing;
use App\Models\Crop_Production;
use App\Models\Crops;
use App\Models\Delivery_Address;
use App\Models\Demands;
use App\Models\Varieties;

class DemandsAPI extends Controller
{
    // Before Crate
    public function create_demands(Request $request)
    {
        ob_start('ob_gzhandler');
            DB::beginTransaction();
        try {
            request()->validate([
                'fk_users_acc_id' => ['required'],
                'fk_crops_id' => ['required'],
                'qty' => ['required'],
                'proposed_delivery_date' => ['required'],
                'variety' => ['required'],
            ]);

            $conso_demands_data = Consolidated_Demands::where('fk_crops_id', $request->fk_crops_id)->get();
            
            if(sizeof($conso_demands_data) > 0){
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                
                $random2 = substr(str_shuffle(str_repeat($pool, 7)), 0, 7);
                $demand = new Demands();
                $demand->fk_users_acc_id = Auth::id();
                $demand->fk_crops_id = $request->fk_crops_id;
                $demand->qty = $request->qty;
                $demand->variety = $request->variety;
                $demand->proposed_delivery_date = $request->proposed_delivery_date;
                $demand->tracking_number = $random2;
                // $demand->fk_consolidated_demands_id = $conso[0]->id;
                $demand->class = $request->class;
                $demand->save();

            }else if(sizeof($conso_demands_data) == 0){
                // 9 digits for date + 7 random string
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random2 = substr(str_shuffle(str_repeat($pool, 7)), 0, 7);
                
                $demand = new Demands();
                $demand->fk_users_acc_id = Auth::id();
                $demand->fk_crops_id = $request->fk_crops_id;
                $demand->qty = $request->qty;
                $demand->variety = $request->variety;
                $demand->proposed_delivery_date = $request->proposed_delivery_date;
                $demand->tracking_number = $random2;
                // $demand->fk_consolidated_demands_id = $conso->id;
                $demand->class = $request->class;
                $demand->save();
            }else{
                return response([
                    'message' => "Error",
                ], 401);
            }

            DB::commit();
            return response([
                'message' => "Demand has been posted successfully",
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 401);
        }
        ob_end_flush();
    }

    // Create Demands On Crate
    public function delete_specific_demands(Request $request)
    {
        // {
        //      "user_id": "1",
        //     "fk_demands_id": "1",
        // }
        ob_start('ob_gzhandler');
            DB::beginTransaction();
            try {
                Demands::where('fk_users_acc_id', $request->user_id)->where('id', $request->fk_demands_id)->where('status', 'Pending')->delete();
                
                DB::commit();
                return response([
                    'message' => "Demand has been deleted successfully",
                ], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response(['message' => $e->getMessage()], 401);
            }
        ob_end_flush();
    }
    
    public function view_demands_my_crate(Request $request)
    {
        // {
        //     "user_id": "1",
        // }
        return Demands::with('crops')->with('crops.crop_pricing')->where('fk_users_acc_id', $request->user_id)->where('status', 'Pending')->get();
    }

    // Create Demands after Crate
    public function check_out_crate(Request $request)
    {
        ob_start('ob_gzhandler');
            DB::beginTransaction();
        try {
            // {
            //     "user_id": "1",
            //      "delivery_method": "Pick_up"
            // }

            $date_append_to_tracking_number = Carbon::now()->format('Y').''.Carbon::now()->format('m').''.Carbon::now()->format('d');
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $batch_tracking_random_string = substr(str_shuffle(str_repeat($pool, 5)), 0, 13);
            $batch_tracking_number = $date_append_to_tracking_number.'-'.$batch_tracking_random_string;
            
            // Create Batch
            $batch_checked_out_demand = new Batch_Checked_Out();
            $batch_checked_out_demand->fk_users_acc_id = $request->user_id;
            $batch_checked_out_demand->batch_tracking_number = $batch_tracking_number;
            $batch_checked_out_demand->save();
            
            // Loop thru Demands
            $arr1 = [];
            $arr2 = [];
            $demands = Demands::where('fk_users_acc_id', $request->user_id)->where('status','Pending')->get();
            foreach ($demands as $dkey) {
                // return $dkey->fk_crops_id;
                // return $dkey->proposed_delivery_date;

                // Insert to Consolidated Demands
                $check_if_in_consolidated_demands = Consolidated_Demands::where('variety', $dkey->variety)->where('class', $dkey->class)->where('fk_crops_id', $dkey->fk_crops_id)->where('proposed_delivery_date', $dkey->proposed_delivery_date)->get();
                // return sizeof($check_if_in_consolidated_demands);
                if(sizeof($check_if_in_consolidated_demands) == 0){
                    // If wala ang crops sa conso demands
                    // array_push($arr1, $check_if_in_consolidated_demands);
                    // return $check_if_in_consolidated_demands;
                    
                    $crops = Crops::with('crop_pricing')->where('id', $dkey->fk_crops_id)->get();

                    $checked_out_demand = new Checked_Out_Demands();
                    $checked_out_demand->delivery_method = $request->delivery_method;
                    $checked_out_demand->fk_demands_id = $dkey->id;
                    $checked_out_demand->fk_batch_tracking_number = $batch_checked_out_demand->batch_tracking_number;
                    $checked_out_demand->save();

                    $date_append_to_tracking_number = Carbon::now()->format('Y').''.Carbon::now()->format('m').''.Carbon::now()->format('d');
                    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $random_str1 = substr(str_shuffle(str_repeat($pool, 5)), 0, 7);
                    $tracking_number = $date_append_to_tracking_number.'-'.$random_str1;

                    $total_amount_fgp = $dkey->qty * $crops[0]->crop_pricing->fgp;
                    $total_amount_srp = $dkey->qty * $crops[0]->crop_pricing->srp;

                    $conso = new Consolidated_Demands();
                    $conso->fk_crops_id = $dkey->fk_crops_id;
                    $conso->total_amount_fgp = $total_amount_fgp;
                    $conso->total_amount_srp = $total_amount_srp;
                    $conso->total_remaining_qty = $dkey->qty;
                    $conso->tracking_number = $tracking_number;
                    $conso->class = $dkey->class;
                    $conso->variety = $dkey->variety;
                    $conso->proposed_delivery_date = $dkey->proposed_delivery_date;
                    $conso->save();

                    // $e = Consolidated_Demands::where('fk_crops_id', $dkey->fk_crops_id)->where('class', $dkey->qty)->latest()->first();
                    $e = Consolidated_Demands::where('variety', $dkey->variety)->where('class', $dkey->class)->where('fk_crops_id', $dkey->fk_crops_id)->where('proposed_delivery_date', $dkey->proposed_delivery_date)->get();
                    // return $e;
                    Demands::where('variety', $dkey->variety)->where('fk_users_acc_id', $dkey->fk_users_acc_id)->where('fk_crops_id', $dkey->fk_crops_id)->where('class', $dkey->class)->where('proposed_delivery_date', $dkey->proposed_delivery_date)->update(['status' => 'Checked_Out', 'fk_consolidated_demands_id' => $e[0]->id]);
                
                }else{
                    // If naa ang crops sa conso demands
                    $crops = Crops::with('crop_pricing')->where('id', $dkey->fk_crops_id)->get();
                    $total_amount_fgp = $dkey->qty * $crops[0]->crop_pricing->fgp;
                    $total_amount_srp = $dkey->qty * $crops[0]->crop_pricing->srp;

                    $checked_out_demand = new Checked_Out_Demands();
                    $checked_out_demand->delivery_method = $request->delivery_method;
                    $checked_out_demand->fk_demands_id = $dkey->id;
                    $checked_out_demand->fk_batch_tracking_number = $batch_checked_out_demand->batch_tracking_number;
                    $checked_out_demand->save();

                    // // Perform Update Consolidated_Demands
                    Consolidated_Demands::where('fk_crops_id', $dkey->fk_crops_id)
                    ->where('status', 'Pending')
                    ->update([
                        'total_remaining_qty' => $check_if_in_consolidated_demands[0]->total_remaining_qty + $dkey->qty,
                        'total_amount_fgp' => $check_if_in_consolidated_demands[0]->total_amount_fgp + $total_amount_fgp,
                        'total_amount_srp' => $check_if_in_consolidated_demands[0]->total_amount_srp + $total_amount_srp,
                    ]);

                    $e = Consolidated_Demands::where('variety', $dkey->variety)->where('class', $dkey->class)->where('fk_crops_id', $dkey->fk_crops_id)->where('proposed_delivery_date', $dkey->proposed_delivery_date)->get();
                    // return $e;
                    Demands::where('variety', $dkey->variety)->where('fk_users_acc_id', $dkey->fk_users_acc_id)->where('fk_crops_id', $dkey->fk_crops_id)->where('class', $dkey->class)->where('proposed_delivery_date', $dkey->proposed_delivery_date)->update(['status' => 'Checked_Out', 'fk_consolidated_demands_id' => $e[0]->id]);
                    // return "check_if_in_consolidated_demands";
                }
            }
            
            DB::commit();
            return response([
                'message' => "Checked Out Successfully",
                'batch_tracking_number' => $batch_checked_out_demand->batch_tracking_number,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 401);
        }
        ob_end_flush();
    }
    
    // Create Invoice
    public function view_check_out_demands(Request $request)
    {
        // View all na Checked Out nga Consolidated Demands
        // {
        //     "user_id": "1",
        //     "batch_tracking_number": "dsdsdsds"
        // }
        // return Batch_Checked_Out::get();
        return Batch_Checked_Out::with('checked_out_demands.demands.crops.crop_pricing')->where('batch_tracking_number', $request->batch_tracking_number)->where('fk_users_acc_id', $request->user_id)->get();
    }

    public function view_batch_ordered(Request $request)
    {
        // {
        //     "user_id": "3"
        // }
        return Batch_Checked_Out::with('checked_out_demands.demands.crops.crop_pricing')->where('fk_users_acc_id', $request->user_id)->get();
    }

    public function view_specific_batch_ordered_list(Request $request)
    {
        // {
        //      "fk_batch_tracking_number": "20211013-L6qU8qziwDzmH",
        // }
        return Checked_Out_Demands::with('demands.crops.crop_pricing')->where('fk_batch_tracking_number', $request->fk_batch_tracking_number)->get();
    }

    public function view_all_demands(Request $request)
    {
        // View all na Checked Out nga Consolidated Demands
        // { Params: Bearer Token }
        return Consolidated_Demands::with('crops')->get();
        // return Demands::with('consolidated_demands')->where('status', 'Checked_Out')->get()->groupBy('fk_consolidated_demands_id');
    }

    public function view_specific_demands(Request $request)
    {
        // View specific na Checked Out nga Consolidated Demands
        // {
        //     "user_id": "1",
        //     "consolidated_demand_id": "1",
        // }
        return Consolidated_Demands::with('demands.crops.crop_pricing')->with('demands.crops.crop_production_model')->where('id',$request->consolidated_demand_id)->where('status', 'Pending')->get();
    }

}
 