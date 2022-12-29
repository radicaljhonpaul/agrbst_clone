<?php

namespace App\Http\Controllers;

use App\Traits\SmsTrait;
use App\Http\Controllers\Controller;
use App\Interfaces\SupplyAndDemandInterface;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SupplyAndDemandController extends Controller
{
    use SmsTrait;

    private SupplyAndDemandInterface $supplyAndDemandRepository;

    public function __construct(SupplyAndDemandInterface $supplyAndDemandRepository) 
    {
        $this->supplyAndDemandRepository = $supplyAndDemandRepository;
    }
    
    public function index(Request $request)
    {
        ob_start('ob_gzhandler');
            return Inertia::render('SupplyAndDemand/SupplyAndDemand', [
                "ConsolidatedDemands" => $this->supplyAndDemandRepository->getAllConsolidatedDemandsWithCommits()->paginate($request->perPage)->appends($request->query()),
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function specificSupplyAndDemands(Request $request)
    {
        ob_start('ob_gzhandler');
            return Inertia::render('SupplyAndDemand/SpecificSupplyAndDemand', [
                "DemandsWithCommits" => $this->supplyAndDemandRepository->demandsWithCommitsViaConsolidatedDemandID($request->consolidated_id)->get(),
                "Commits" => $this->supplyAndDemandRepository->getCommitsViaDemandID($request->consolidated_id)->get(),
                // "Commits" => $this->supplyAndDemandRepository->getCommitsViaDemandID($this->supplyAndDemandRepository->demandsWithCommitsViaConsolidatedDemandID($request->consolidated_id)->get()->map(function($e){ return $e->id; }))->get(),
                "ConsolidatedDemandDetails" => $this->supplyAndDemandRepository->specificConsolidatedDemand($request->consolidated_id)->get(),
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function approveCommit(Request $request)
    {
        ob_start('ob_gzhandler');
            return $this->supplyAndDemandRepository->approveCommit($request->commitID, $request->demandID, $request->demands_array);
        ob_end_flush();
    }

    public function disApproveCommit(Request $request)
    {
        ob_start('ob_gzhandler');
            return $this->supplyAndDemandRepository->disApproveCommit($request->commitID);
        ob_end_flush();
    }

    public function getCalendarView(Request $request)
    {
        ob_start('ob_gzhandler');
            return Inertia::render('SupplyAndDemand/SupplyAndDemandCalendarView', [
                "DemandAndSupply" => $this->supplyAndDemandRepository->getCalendarView($request->month),
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }
    
}
