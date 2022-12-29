<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AuthorizedPerson;
use App\Models\ConsolidatedDemand;
use App\Models\MappedTransaction;
use Carbon\Carbon;
use stdClass;

class TraderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function traderLogin(Request $request) {
        request()->validate([
            'mobile_number' => 'required',
            'password' => 'required',
        ]);

        $UserDetail = DB::table('user_details')->where('user_details.phone', $request->mobile_number)->get();
        // return $UserDetail;

        if (count($UserDetail) == 0){
            return response(['message' => 'Invalid Credentials you idiot'], 401);
        }
        
        $User = User::where('id', $UserDetail[0]->user_id)->first();

        $BusinessDetail = DB::table('business_details')->where('business_details.user_detail_id', $UserDetail[0]->id)->get();
            

        if ($User->user_type != 'trader' || ! Hash::check($request->password, $User->password)) {
            return response(['message' => 'Invalid Credentials you idiotaasasa'], 401);
        }

        return response([
            'user' => $User,
            'user_details' => $UserDetail[0],
            'business_details' => $BusinessDetail[0],
            'token' => $User->createToken($User->id)->plainTextToken,
        ], 200);
    }

    public function showProfile()
    {
        //
        // return Auth::id();

        $user = User::find(Auth::id());
        $user_details = DB::table('user_details')->where('user_details.user_id', $user->id)->get();
        $business_details = DB::table('business_details')->where('business_details.user_detail_id', $user_details[0]->id)->get();
        // $authorized_person = DB::table('authorized_people')->where('authorized_people.user_id', $user->id)->get();
        // $user_details[0]->image_path = url('public/Image/'.$user_details[0]->image_path);
        return response([
            'user' => $user,
            'user_details' => $user_details[0],
            'business_details' => $business_details[0],
            // 'authorized_person' => $authorized_person
        ]);
    }

    public function checkout(Request $request)
    {
        
        // return gettype(strtotime(DB::table('demands')->where('id', 1)->get()[0]->date));
        // return carbon::parse(DB::table('demands')->where('id', 1)->get()[0]->date)->subDays(90)->format('Y/m/d');
        // return DB::table('mapped_transactions')->get();
        DB::beginTransaction();
        try {

            // return DB::table('demands')->get();

            //get the logged in user
            $user = User::find(Auth::id());
            // return $user->id;
            $arrayOfData = [];
            $count = DB::table('mapped_transactions')->count();
            $count_record = 0;
            $mapped_increment = 0;
            $consolidated_increment = 0;
            $consolidated_qty = 0;
            $consolidated_amount = 0;
            $mapped_transaction_amount = 0;
            $date =  Carbon::now()->format('Ymd');


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
            $mapped_transaction->user_id = $user->id;
            $mapped_transaction->transaction_no = "BXU-PRE-".$user->id."-".$date."-".str_pad($mapped_increment,4,0,STR_PAD_LEFT);
            $mapped_transaction->transaction_type = "PRE-ORDER";

            //get the total amount of checkout
            foreach ($request->checkout as $key => $value) {
                $mapped_transaction_amount += $value['amount'];
            }

            $mapped_transaction->amount = $mapped_transaction_amount;
            // $mapped_transaction->payment_method = ;
            // $mapped_transaction->status = ;
            $mapped_transaction->save();


            
            // loop thru the checkout requests that stored in $value and use to create new or add to existing consolidated_demands
            foreach ($request->checkout as $key => $value) {
                // return str_replace("-","",$value['date']);
                $mapped_transaction_amount += $value['amount'];
                $value['user_id'] = $user['id'];
                $value['mapped_transaction_id'] = $mapped_transaction['id'];
                
                //query to consolidated demands and check if the new checkout already exist.
                $consolidated_demand = DB::table('consolidated_demands')
                ->where('consolidated_demands.crop_id', $value['crop_id'])
                ->where('consolidated_demands.variety_id', $value['variety_id'])
                ->where('consolidated_demands.class_id', $value['class_id'])
                ->where('consolidated_demands.price_id', $value['price_id'])
                ->where('consolidated_demands.date', $value['date'])
                ->get();
                
                // if exist, add the new demand to existing consolidated_demand
                if(sizeof($consolidated_demand) != 0){
                    $value['consolidated_demand_id'] = $consolidated_demand[0]->id;
                    $consolidated_qty = $consolidated_demand[0]->consolidated_qty + $value['qty'];
                    $consolidated_amount = $consolidated_demand[0]->consolidated_amount + $value['amount'];


                    //update consolidated_demand quantity if there's a new demand that falls on that same consolidated_demand
                    DB::table('consolidated_demands')
                    ->where('consolidated_demands.id', $consolidated_demand[0]->id)
                    ->update([
                        'consolidated_qty' => $consolidated_qty,
                        'consolidated_amount' => $consolidated_amount
                    ]);

                }

                
                //if not exist, create new consolidated_demands for that new demand. pakyo ka
                else{


                    // get the last ID for increments in pool_no
                    $last_consolidated_id = DB::table('consolidated_demands')->orderBy('id', 'DESC')->first()->id;
                    $consolidated_increment = $last_consolidated_id + 1;

                    $new_consolidated_demand = new ConsolidatedDemand();
                    $new_consolidated_demand->crop_id = $value['crop_id'];
                    $new_consolidated_demand->variety_id = $value['variety_id'];
                    $new_consolidated_demand->class_id = $value['class_id'];
                    $new_consolidated_demand->price_id = $value['price_id'];
                    $new_consolidated_demand->date = $value['date'];
                    $new_consolidated_demand->pool_no = "BXU-PRE-".$value['crop_id']."-".str_replace("-","",$value['date'])."-".str_pad($consolidated_increment,4,0,STR_PAD_LEFT);
                    $new_consolidated_demand->consolidated_qty = $value['qty'];
                    $new_consolidated_demand->consolidated_amount = $value['amount'];
                    $new_consolidated_demand->status = $value['status'];
                    $new_consolidated_demand->save();

                    //for consolidated_demand_id in demands table
                    $value['consolidated_demand_id'] = $new_consolidated_demand->id;
                }

                // return $value;
                //insert demand every loop
                DB::table('demands')->insert($value);
                
            }
            
            DB::commit();
            // return DB::table('consolidated_demands')->get();
            return response([
                'message' => 'checked out successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 401);
        }

    }

    public function transactionHistory()
    {   
        $user = User::find(Auth::id());
        $mapped_transaction = DB::table('mapped_transactions')
        ->where('user_id', $user->id)
        ->get();

        return $mapped_transaction;
    }


    public function transactionHistoryDetails(Request $request)
    {
        if (!$request->mapped_id) {
            return "invalid request";
        }
        else{
        $user = User::find(Auth::id());
        $check_out = DB::table('demands')->where('mapped_transaction_id', $request->mapped_id)->get();

        return response([
            'details' => $check_out
        ]);
        }
    }

    public function showOrderDetails(Request $request)
    {
        //  
        // request()->validate([
        //     'crop_id' => 'required'
        // ]);
        $user = User::find(Auth::id());
        // return $user->id;

        $mapped_transaction = DB::table('demands')->where('demands.user_id', $user->id)->get();
        return $mapped_transaction;

        $crop = DB::table('crops')
        ->where('crops.id', $request->crop_id)->get();
        // return $crop[0]->id;
        $varieties = DB::table('crop_varieties')->where('crop_varieties.crop_id', $crop[0]->id)->get();
        $classes = DB::table('crop_classes')->where('crop_classes.crop_id', $crop[0]->id)->get();
        $pricings = DB::table('crop_pricings')->where('crop_pricings.crop_id', $crop[0]->id)->get();

        return response([
            'crop' => $crop,
            'varieties' => $varieties,
            'classes' => $classes,
            'pricings' => $pricings
        ]);
    }
    
    public function edit($id)
    {
        //
        return $this->showProfile();
    }

    
    public function updateProfile(Request $request)
    {
        //
        // return User::find(Auth::id());

        $user = User::find(Auth::id());
        // return $user->id;

        // return $request->phone;
        $file = $request->file('profile_pic');
        // return $file->getClientOriginalName();
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('images/userProfile'), $filename);
        DB::table('user_details')->where('user_details.user_id', $user->id)->update([
            'image_path' => $filename,
            'phone' => $request->phone
        ]);
        return response([
            'message' => 'Updated successfully'
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       
    }
}
