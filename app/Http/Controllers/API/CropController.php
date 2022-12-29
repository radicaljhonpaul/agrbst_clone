<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CropClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CropVariety;
use App\Models\Crop;
use stdClass;

class CropController extends Controller
{
    //
    public function search(Request $request)
    {

        //search
        $crops = DB::table('crops')
        ->where('crops.crop_type','LIKE', '%'.$request->crop_type.'%')
        ->where('crops.name','LIKE', '%'.$request->crop_name.'%')
        ->paginate(5);

        $cropsTmp = new stdClass;
        $cropsTmp->next_page_url = $crops->nextPageUrl();
        $cropsTmp->prev_page_url = $crops->previousPageUrl();
        $cropsTmp->count = count($crops->items());
        $cropsTmp->data = $crops->items();

        // return $cropsTmp;

        for ($i = 0; $i < count($cropsTmp->data); $i++) {
            // return  $crops->items()[$i];
            $pricing = DB::table('crop_pricings')
            ->where('crop_pricings.crop_id','=', $cropsTmp->data[$i]->id)
            ->select('unit', 'fgp', 'smp', 'qty')
            ->get();

            $info = [
                'id' => $cropsTmp->data[$i]->id,
                'crop_name' => $cropsTmp->data[$i]->name,
                'pricings' => $pricing
            ];

            $cropsTmp->data[$i] = $info;
            // // $crop_pricings = 
        }

        
        return response([
            'crops' => $cropsTmp,
        ]);

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCropDetails(Request $request)
    {
        request()->validate([
            'crop_id' => 'required'
        ]);


        $crop = DB::table('crops')
        ->where('crops.id', $request->crop_id)->get();
        // return $crop[0]->id;
        $varieties = DB::table('crop_varieties')->where('crop_varieties.crop_id', $crop[0]->id)
        ->select('crop_varieties.id','crop_varieties.crop_id','crop_varieties.name')
        ->get();
        $classes = DB::table('crop_classes')->where('crop_classes.crop_id', $crop[0]->id)->get();
        $pricings = DB::table('crop_pricings')->where('crop_pricings.crop_id', $crop[0]->id)
        ->select('crop_pricings.id','crop_pricings.fgp','crop_pricings.smp','crop_pricings.unit',
        'crop_pricings.crop_id','crop_pricings.class_id','crop_pricings.variety_id')
        ->get();
        $crop_productions = DB::table('crop_productions')->where('crop_productions.crop_id', $crop[0]->id)
        ->select('crop_productions.dr', 'crop_productions.dh', 'crop_productions.maturity_from', 'crop_productions.maturity_to',
        'crop_productions.harvesting','crop_productions.qty_hills')->get();

        $crop_details = new stdClass;
        $crop_pricings = new stdClass;
        $crop_details->crop_id = $crop[0]->id;
        $crop_details->crop_name = $crop[0]->name;
        $crop_details->crop_type = $crop[0]->crop_type;
        $crop_details->seasonality = $crop[0]->seasonality;
        $crop_details->pricings = $pricings[0];
        $crop_details->crop_productions = $crop_productions[0];
        $crop_details->varieties = $varieties;
        $crop_details->classes = $classes;


        return $crop_details;
        return response([
            // 'crop' => $crop[0],
            // 'varieties' => $varieties,
            // 'classes' => $classes,
            // 'pricings' => $pricings
        ]);

        return [$crop[0], $varieties];

       
    }

    
}
