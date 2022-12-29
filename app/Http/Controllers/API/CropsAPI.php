<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Crops;

class CropsAPI extends Controller
{
    public function available_crops(Request $request)
    {
        // Get all Crops
        return Crops::with('varieties')
            ->with('crop_pricing')
            ->with('crop_production_model')
            ->get();
    }
    public function search(Request $request)
    {
            request()->validate([
                // 'crop_type' => 'required',
                'crop_name' => 'required',
            ]);

        return DB::table('crops')
        ->where('crops.name','LIKE', '%'.$request->crop_name.'%')->get();

    }
    

}
