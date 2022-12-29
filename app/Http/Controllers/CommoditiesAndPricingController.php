<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Models\Bids;
use App\Models\Consolidated_Demands;
use App\Models\Crops;
use App\Models\User;

class CommoditiesAndPricingController extends Controller
{
    //

    public function commoditiesAndPricing(Request $request){
        ob_start('ob_gzhandler');
            return Inertia::render('CommoditiesAndPrices/CommoditiesAndPricingList', [
                "CommoditiesAndPricing" => Crops::with('varieties')
                ->with('varieties')
                ->with('crop_pricing')
                ->with('crop_production_model')
                ->with('crop_production_harvesting_model')
                ->paginate(10),
            ]);
        ob_end_flush();
    }

    public function specificCommoditiesAndPricing(Request $request){
        ob_start('ob_gzhandler');
            return Inertia::render('CommoditiesAndPrices/SpecificCommodity', [
                "SpecificCommodity" => Crops::with('varieties')
                ->with('varieties')
                ->with('crop_pricing')
                ->with('crop_production_model')
                ->with('crop_production_harvesting_model')
                ->where('id', $request->id)->get(),
            ]);
        ob_end_flush();
    }

    
    
}
