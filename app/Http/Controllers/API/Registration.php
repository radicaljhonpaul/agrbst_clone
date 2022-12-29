<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

use App\Models\User;
use App\Models\CropProduction;
use App\Models\CropProductionHarvestingModel;
use App\Models\CropPricing;
use App\Models\UserDetail;
use App\Models\BusinessDetail;
use App\Models\FarmDetail;

class Registration extends Controller
{

    // API for registration
    public function mobile_registration(Request $request){
        ob_start('ob_gzhandler');
            DB::beginTransaction();
        try {

            // $user_data = User::create([
            //     'email' => $request['email'],
            //     'user_type' => $request['user_type'],
            //     'password' => Hash::make($request['password']),
            // ]); 
            // return $request->email;
            // return DB::table('authorized_people')->where('user_id', 25)->get();
            

            // $crop_princings = DB::table('crop_pricings')->join('crops', 'crops.id', '=', 'crop_pricings.crop_id')
            // ->select('crops.name as crop_name', 'crop_pricings.smp as price', 'crops.id as crop_id')->get();


            // $traders = DB::table('users')->where('users.user_type', 'trader')->get();
            // // return DB::table('users')->where('users.user_type', 'trader')->get();

            // $varieties = DB::table('crop_varieties')->join('crops', 'crops.id', '=', 'crop_varieties.crop_id')->where('crop_varieties.crop_id', 1)
            // ->select('crops.name as crop_name', 'crop_varieties.variety_name as variety_name', 'crops.id as crop_id', 'crop_varieties.id as variety_id')->get();

            // return [$crop_princings, $varieties, $traders];

            // new user
            $user_data = new User();
            $user_data->email = $request->email;
            $user_data->user_type = $request->user_type;
            $user_data->status = $request->status;
            $user_data->password = Hash::make($request['password']);
            
            // check if email was taken
            $User = DB::table('users')->where('email', $request->email)->get();
            
            if (count($User) !=0 ){
                return response(['message' => 'Email Already Taken'], 401);
            }
            $user_data->save();

            



            if($user_data){
                $User = User::select('id','email')->where('email',$request['email'])->get();
    
                $UserDetails = new UserDetail();
                $UserDetails->user_id = $User[0]['id'];
                $UserDetails->fname = $request->userDetails['fname']; 
                $UserDetails->lname = $request->userDetails['lname'];
                $UserDetails->sex = $request->userDetails['sex'];
                $UserDetails->bday = $request->userDetails['bday'];
                $UserDetails->phone = $request->userDetails['phone'];
                $UserDetails->region = $request->userDetails['region'];
                $UserDetails->province = $request->userDetails['province'];
                $UserDetails->city = $request->userDetails['city'];
                $UserDetails->brgy = $request->userDetails['brgy'];
                $UserDetails->long = $request->userDetails['long'];
                $UserDetails->lat = $request->userDetails['lat'];

                $User_phone = DB::table('user_details')->where('phone', $request->userDetails['phone'])->get();
                if (count($User_phone) !=0 ){
                    return response(['message' => 'Phone number already taken'], 401);
                }
                $UserDetails->save();

                // If farmer
                if($request['user_type'] == 'farmer'){
                    $FarmDetail = new FarmDetail();
                    $FarmDetail->user_detail_id = $UserDetails['id'];
                    $FarmDetail->farm_name = $request->farmDetails['farm_name'];
                    $FarmDetail->farm_size = $request->farmDetails['farm_size'];
                    $FarmDetail->region = $request->farmDetails['region'];
                    $FarmDetail->province = $request->farmDetails['province'];
                    $FarmDetail->city = $request->farmDetails['city'];
                    $FarmDetail->brgy = $request->farmDetails['brgy'];
                    $FarmDetail->long = $request->farmDetails['long'];
                    $FarmDetail->lat = $request->farmDetails['lat'];
                    $FarmDetail->save();
                
                }
                
                // If Trader
                if($request['user_type'] == 'trader'){
                    $BusinessDetail = new BusinessDetail();
                    $BusinessDetail->user_detail_id = $UserDetails['id'];
                    $BusinessDetail->business_name = $request->businessDetails['business_name'];
                    $BusinessDetail->nature_of_business = $request->businessDetails['nature_of_business'];
                    $BusinessDetail->business_permit_no = $request->businessDetails['business_permit_no'];
                    $BusinessDetail->region = $request->businessDetails['region'];
                    $BusinessDetail->province = $request->businessDetails['province'];
                    $BusinessDetail->city = $request->businessDetails['city'];
                    $BusinessDetail->brgy = $request->businessDetails['brgy'];
                    $BusinessDetail->long = $request->businessDetails['long'];
                    $BusinessDetail->lat = $request->businessDetails['lat'];
                    $BusinessDetail->save();
                }

                

            }else;

            DB::commit();
        
            $token = $user_data->createToken($user_data->id)->plainTextToken;
            if($user_data->user_type === "farmer"){
                return response([
                    'message' => "Registered Successfully",
                    'user' => $user_data,
                    'user_details' => $UserDetails,
                    'farm_details' => $FarmDetail,
                    'token' => $token,
                ], 200);
            }
            else{
                return response([
                    'message' => "Registered Successfully",
                    'user' => $user_data,
                    'user_details' => $UserDetails,
                    'business_details' => $BusinessDetail,
                    'token' => $token,
                ], 200);
            }
        
        } 

        catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 401);
        }
        ob_end_flush();
    }
}
