<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\InventoryAndOrdersInterface;
use App\Models\ConsolidatedDemand;
use App\Traits\SmsTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class InventoryAndOrdersController extends Controller
{
    use SmsTrait;

    private InventoryAndOrdersInterface $inventoryAndOrdersRepository;

    public function __construct(InventoryAndOrdersInterface $inventoryAndOrdersRepository) 
    {
        $this->inventoryAndOrdersRepository = $inventoryAndOrdersRepository;
    }

    public function index(Request $request){
        ob_start('ob_gzhandler');

            return Inertia::render('Inventory/Inventory', [
                "Demands" => $this->inventoryAndOrdersRepository->getConsolidatedDemandsByDateInAMonth(Carbon::now()->month)->get(),
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function getPerDate(Request $request){
        ob_start('ob_gzhandler');
            // return $this->inventoryAndOrdersRepository->getConsolidatedDemandsByDate($request->date)->get();
            return Inertia::render('Inventory/InventoryPerDate', [
                "Demands" => $this->inventoryAndOrdersRepository->getConsolidatedDemandsByDate($request->date)->get(),
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function getPerMonth(Request $request){
        ob_start('ob_gzhandler');
            return $this->inventoryAndOrdersRepository->getConsolidatedDemandsByDateInAMonth($request->monthNum)->get();
        ob_end_flush();
    }
}
