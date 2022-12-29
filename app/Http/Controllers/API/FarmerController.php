<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Commit;
use App\Models\HarvestData;
use App\Models\AuthorizedPerson;
use stdClass;
use Carbon\Carbon;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function farmerLogin(Request $request) {

        request()->validate([
            'mobile_number' => 'required',
            'password' => 'required',
        ]);
        $UserDetail = DB::table('user_details')->where('user_details.phone', $request->mobile_number)->get();

        if (count($UserDetail) == 0){
            return response(['message' => 'Invalid Credentials you idiot'], 401);
        }

        $User = User::where('id', $UserDetail[0]->user_id)->first();

        $FarmDetail = DB::table('farm_details')
        ->where('farm_details.user_detail_id', $UserDetail[0]->id)
        ->get();
            
        if ($User->user_type != 'farmer' || ! Hash::check($request->password, $User->password)) {
            return response(['message' => 'Invalid Credentials you idiot'], 401);
        }

        return response([
            'user' => $User,
            'user_details' => $UserDetail[0],
            'farm_details' => $FarmDetail[0],
            'token' => $User->createToken($User->id)->plainTextToken,
        ], 200);
    }

     /**
     * commit to a demand
     * 
     * @return \Illuminate\Http\Response
     */
    public function commitCalculation(Request $request)
    {   
        request()->validate([
            'crop_id' => 'required'
        ]);
        $crop_production_harvesting  = DB::table('crop_production_harvesting_models')
        ->where('crop_id', $request->crop_id)
        ->where('week_no', 1)
        ->get();

        $crop_production = DB::table('crop_productions')
        ->where('id', $request->crop_id)
        ->get();

        $default_hills_per_1000sqm = $crop_production[0]->qty_hills;
        
        if($request->qty){
            $hills = ($request->qty / $crop_production_harvesting[0]->value) / $default_hills_per_1000sqm;
            $sqm =  $hills * 1000;

            return round($sqm, 2)." sqm";
            // return $hills;
            
        }

        if ($request->sqm) {
            $sqm = $request->sqm / 1000;
            $hills = $sqm * $default_hills_per_1000sqm;
            $qty = $hills *  $crop_production_harvesting[0]->value;

            return $qty;
            
        }

        // return $crop_production_harvesting;



        // request()->validate([
        //     'consolidated_demand_id' => 'required'
        // ]);

        // $farmer_details = new stdClass;
        // $crop_details = new stdClass;

        // $consolidated_demand = DB::table('consolidated_demands')->where('consolidated_demands.id', $request->consolidated_demand_id)->get();
        // //get crop_productions
        // $crop_productions = DB::table('crop_productions')->where('crop_productions.crop_id', $consolidated_demand[0]->crop_id)->get(); 

        // $crop_details->crop_production = $crop_productions[0];
        // return $crop_details;

    }

    public function commit(Request $request)
    {
        // return DB::table('commits')->get();
        request()->validate([
            'consolidated_demand_id' => 'required',
            'qty' => 'required',
            'commited_farm_size' => 'required',
        ]);
        $user = User::find(Auth::id());
        $commit = new Commit();
        $commit->user_id = $user->id;
        $commit->consolidated_demand_id = $request->consolidated_demand_id;
        $commit->qty = $request->qty;
        $commit->commited_farm_size = $request->commited_farm_size;
        $commit->status = 'pending';
        $commit->save();

        return response([
            'message' => 'commit posted successfully. Please wait for the Approval.'
        ]);

    }

    public function myCommitments(Request $request)
    {
        $user = User::find(Auth::id());
        $commits = DB::table('commits')->where('user_id', $user->id)->get();

        return $commits;

    }

    public function sales(Request $request)
    {
        $user = User::find(Auth::id());
        $sales = 0;
        $commits = DB::table('commits')
        ->where(function ($query) use ($user) {
            $query->where('commits.user_id', $user->id);
            $query->where('commits.status', 'approved');
        })
        ->join('commit_demand_transactions', 'commit_demand_transactions.commit_id', '=', 'commits.id')
        ->select('commit_demand_transactions.*')
        ->get();
        // return $commits;
        // sales
        for ($i=0; $i < count($commits); $i++) { 
            $sales += $commits[$i]->amount_receivable;
        }

        return $sales;

    }

    public function deliveries(Request $request)
    {
        $user = User::find(Auth::id());

        $commits = DB::table('commits')
        ->where(function ($query) use ($user) {
            $query->where('commits.user_id', $user->id);
            $query->where('commits.status', 'approved');
        })
        ->join('commit_demand_transactions', 'commit_demand_transactions.commit_id', '=', 'commits.id')
        ->join('demands', 'demands.id', '=', 'commit_demand_transactions.demand_id')->where('demands.status', '!=', 'delivered')
        ->select('demands.date as date')
        ->get();
        // return $commits;
        $dates = [];
        for ($i=0; $i < count($commits); $i++) { 
            array_push($dates, $commits[$i]);
        }

        return $dates;
    }

    public function harvestData(Request $request)
    {
        // return DB::table('commits')->get();
        request()->validate([
            'crop_id' => 'required',
            'planting_date' => 'required',
        ]);
        $user = User::find(Auth::id());
        $commit = new HarvestData();
        $commit->crop_id = $request->crop_id;
        $commit->planting_date = $request->planting_date;
        $commit->harvest_data_type = 'planted';
        $commit->commited_farm_size = $request->commited_farm_size;
        $commit->status = 'pending';
        $commit->save();

        return response([
            'message' => 'commit posted successfully. Please wait for the Approval sir ha?'
        ]);

    }
    
    //search demand (consolidated)
    public function search(Request $request)
    {

        // constant
        $date = Carbon::now();
        $required_data = new stdClass;
        
        // default, if request has no dates
        if ($request->crop_id && !$request->month && !$request->day && !$request->year && !$request->crop_name) {
            
            $data_crops = DB::table('crops')->where('crops.id', $request->crop_id)->get();
            $data_crop_productions = DB::table('crop_productions')->where('crop_productions.id', $data_crops[0]->id)->get();
            $data_crop_production_harvesting = DB::table('crop_production_harvesting_models')->where('crop_production_harvesting_models.crop_id', $data_crops[0]->id)->first();

            $required_data->maturity_date = $data_crop_productions[0]->maturity_to;
            $required_data->default_hills_per_1000sqm = $data_crop_productions[0]->qty_hills;
            $required_data->weekly_freq_harvest = $data_crop_productions[0]->harvesting;
            $required_data->multiplier = $data_crop_production_harvesting->value;

            // $demands = DB::table('consolidated_demands')
            // ->where('consolidated_demands.crop_id', $request->crop_id)
            // ->where(function($query) use ($date){
            //     $query->whereYear('consolidated_demands.date', $date->year);
            //     $query->where(function ($query2) use ($date){
            //         $query2->whereMonth('consolidated_demands.date', $date->month);
            //     });
            // })
            // ->get();

            $demands = DB::table('consolidated_demands')
            ->where('consolidated_demands.crop_id', $request->crop_id)
            ->orderBy('date')
            ->first();
            // return $demands->date;
            // return Carbon::parse($demands->date)->format('Y');
            $demand = DB::table('consolidated_demands')
            ->where('consolidated_demands.crop_id', $request->crop_id)
            // ->where(fn )
            ->whereMonth('date', Carbon::parse($demands->date)->format('m'))
            ->whereYear('date', Carbon::parse($demands->date)->format('Y'))
            ->get();
            
            return response([
                'consolidated_demands' => $demand,
                'data' => $required_data
            ]);
        }
        // return $data;

        


        // if request->crop_name. (use for searching)
        if (($request->crop_name || $request->crop_name == '') && !$request->crop_id && !$request->month && !$request->day && !$request->year) {
            $crop = new stdClass;
            
            $demand = DB::table('crops')->where('crops.name','LIKE', '%'. $request->crop_name .'%')
                ->join('consolidated_demands','crops.id', '=', 'consolidated_demands.crop_id')
                ->select('crops.name','consolidated_demands.crop_id', 'consolidated_demands.price_id')
                ->distinct()
                ->get();
            $data = json_decode(json_encode($demand), true);
            $crop->demands = array_map(function ($arr) {
                $arr['count'] = DB::table('consolidated_demands')->where('consolidated_demands.crop_id', $arr['crop_id'])
                    ->count();
                    // return $arr;
                $arr['fgp'] = DB::table('crop_pricings')->where('crop_pricings.id', $arr['price_id'])->get()[0]->fgp;
                return $arr;
            }, $data);
            return $crop;
        }
        
        // //default. if request has no date. 
        // elseif ($request->crop_id && !$request->month && !$request->crop_name && !$request->day) {
        //     $demands = DB::table('consolidated_demands')
        //     ->where('consolidated_demands.crop_id', $request->crop_id)
        //     ->where(function($query) use ($date){
        //         $query->whereYear('consolidated_demands.date', $date->year);
        //         $query->where(function ($query2) use ($date){
        //             $query2->whereMonth('consolidated_demands.date', $date->month);
        //         });
        //     })
        //     ->get();

        //     return response([
        //         'consolidated_demands' => $demands,
        //         'data' => $required_data
        //     ]);
        // }

        // for list view with month
        elseif ($request->crop_id && $request->month && !$request->crop_name && !$request->day && !$request->year) {
            $consolidated_demands = new stdClass;
            
            $consolidated_demand = DB::table('consolidated_demands')
            ->where('consolidated_demands.crop_id', $request->crop_id)
            ->whereMonth('consolidated_demands.date', $request->month)
            ->get();
            // return $consolidated_demand;
            $data = json_decode(json_encode($consolidated_demand), true);
            $consolidated_demands->consolidated_demand = array_map(function ($arr) {

                $variety = DB::table('crop_varieties')->where('crop_varieties.id', $arr['variety_id'])
                ->select('name')
                ->get();
                if (count($variety) == 0) {
                    $arr['variety'] = "";
                }
                else{
                    $arr['variety'] = $variety[0]->name;
                }

                $class = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                ->select('name')
                ->get();
                if (count($class) == 0) {
                    $arr['class'] = "";
                }
                else{
                    $arr['class'] = $class;
                }

                $crop = DB::table('crops')->where('crops.id', $arr['crop_id'])
                ->select('name')
                ->get();
                if (count($crop) == 0) {
                    $arr['crop_name'] = "";
                }
                else{
                    $arr['crop_name'] = $crop[0]->name;
                }
               

                // $arr['class'] = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                // ->select('name')
                // ->get();
                return $arr;
            }, $data);
            // $consolidated_demands->consolidated_demand = $consolidated_demand;
            return response([
                'consolidated_demands' => $consolidated_demands->consolidated_demand,
                'data' => $required_data
            ]);
        }

        // for list view with month and day
        elseif ($request->crop_id && $request->month && $request->day && !$request->crop_name && !$request->year) {
            $consolidated_demands = new stdClass;
            
            $consolidated_demand = DB::table('consolidated_demands')
            ->where('consolidated_demands.crop_id', $request->crop_id)
            ->where(function($query) use ($request){
                $query->whereMonth('consolidated_demands.date', $request->month);
                $query->where(function ($query2) use ($request){
                    $query2->whereDay('consolidated_demands.date', $request->day);
                });
            })
            ->get();

            $data = json_decode(json_encode($consolidated_demand), true);
            $consolidated_demands->consolidated_demand = array_map(function ($arr) {

                $variety = DB::table('crop_varieties')->where('crop_varieties.id', $arr['variety_id'])
                ->select('name')
                ->get();
                if (count($variety) == 0) {
                    $arr['variety'] = "";
                }
                else{
                    $arr['variety'] = $variety[0]->name;
                }

                $class = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                ->select('name')
                ->get();
                if (count($class) == 0) {
                    $arr['class'] = "";
                }
                else{
                    $arr['class'] = $class;
                }

                $crop = DB::table('crops')->where('crops.id', $arr['crop_id'])
                ->select('name')
                ->get();
                if (count($crop) == 0) {
                    $arr['crop_name'] = "";
                }
                else{
                    $arr['crop_name'] = $crop[0]->name;
                }
               

                // $arr['class'] = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                // ->select('name')
                // ->get();
                return $arr;
            }, $data);

            return response([
                'consolidated_demands' => $consolidated_demands->consolidated_demand,
                'data' => $required_data
            ]);
        }

        // for list view with month and year
        elseif ($request->crop_id && $request->month && !$request->day && !$request->crop_name && $request->year) {
            $consolidated_demands = new stdClass;
            
            $consolidated_demand = DB::table('consolidated_demands')
            ->where('consolidated_demands.crop_id', $request->crop_id)
            ->where(function($query) use ($request){
                $query->whereYear('consolidated_demands.date', $request->year);
                $query->where(function ($query2) use ($request){
                    $query2->whereMonth('consolidated_demands.date', $request->month);
                });
            })
            ->get();
            return $consolidated_demand;

            $data = json_decode(json_encode($consolidated_demand), true);
            $consolidated_demands->consolidated_demand = array_map(function ($arr) {

                $variety = DB::table('crop_varieties')->where('crop_varieties.id', $arr['variety_id'])
                ->select('name')
                ->get();
                if (count($variety) == 0) {
                    $arr['variety'] = "";
                }
                else{
                    $arr['variety'] = $variety[0]->name;
                }

                $class = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                ->select('name')
                ->get();
                if (count($class) == 0) {
                    $arr['class'] = "";
                }
                else{
                    $arr['class'] = $class;
                }

                $crop = DB::table('crops')->where('crops.id', $arr['crop_id'])
                ->select('name')
                ->get();
                if (count($crop) == 0) {
                    $arr['crop_name'] = "";
                }
                else{
                    $arr['crop_name'] = $crop[0]->name;
                }
               

                // $arr['class'] = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                // ->select('name')
                // ->get();
                return $arr;
            }, $data);

            return response([
                'consolidated_demands' => $consolidated_demands->consolidated_demand,
                'data' => $required_data
            ]);
        }

         // for list view with month, day, and year
         elseif ($request->crop_id && $request->month && $request->day && $request->year && !$request->crop_name) {
            // return $request->year;
            $consolidated_demands = new stdClass;
            
            $consolidated_demand = DB::table('consolidated_demands')
            ->where('consolidated_demands.crop_id', $request->crop_id)
            ->where(function($query) use ($request){
                $query->whereMonth('consolidated_demands.date', $request->month);
                $query->where(function ($query2) use ($request){
                    $query2->whereDay('consolidated_demands.date', $request->day);
                    $query2->where(function ($query3) use ($request){
                        $query3->whereYear('consolidated_demands.date', $request->year);
                    });
                });
                
               
            })
            ->get();

            $data = json_decode(json_encode($consolidated_demand), true);
            $consolidated_demands->consolidated_demand = array_map(function ($arr) {

                $variety = DB::table('crop_varieties')->where('crop_varieties.id', $arr['variety_id'])
                ->select('name')
                ->get();
                if (count($variety) == 0) {
                    $arr['variety'] = "";
                }
                else{
                    $arr['variety'] = $variety[0]->name;
                }

                $class = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                ->select('name')
                ->get();
                if (count($class) == 0) {
                    $arr['class'] = "";
                }
                else{
                    $arr['class'] = $class;
                }

                $crop = DB::table('crops')->where('crops.id', $arr['crop_id'])
                ->select('name')
                ->get();
                if (count($crop) == 0) {
                    $arr['crop_name'] = "";
                }
                else{
                    $arr['crop_name'] = $crop[0]->name;
                }
               

                // $arr['class'] = DB::table('crop_classes')->where('crop_classes.id', $arr['class_id'])
                // ->select('name')
                // ->get();
                return $arr;
            }, $data);

            return response([
                'consolidated_demands' => $consolidated_demands->consolidated_demand,
                'data' => $required_data
            ]);
        }

        else {
            return response([
                'message' => 'invalid request'
            ]);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $user = User::find(Auth::id());
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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