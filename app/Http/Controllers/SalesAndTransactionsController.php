<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\SalesAndTransactionsInterface;
use App\Models\MappedTransaction;
use App\Traits\SmsTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class SalesAndTransactionsController extends Controller
{
    use SmsTrait;

    private SalesAndTransactionsInterface $salesAndTransactionsRepository;

    public function __construct(SalesAndTransactionsInterface $salesAndTransactionsRepository) 
    {
        $this->salesAndTransactionsRepository = $salesAndTransactionsRepository;
    }
    
    public function index(Request $request)
    {
        ob_start('ob_gzhandler');
        return Inertia::render('SalesAndTransactions/SalesAndTransactions', [
            "Transactions" => $this->salesAndTransactionsRepository->getAllMappedTransactionsDemandsWithCommits()->paginate($request->perPage)->appends($request->query()),
            "RoutePrefix" => Route::current()->action['prefix'],
        ]);
        ob_end_flush();
    }

    public function paymentHistory(Request $request)
    {
        ob_start('ob_gzhandler');
            return Inertia::render('SalesAndTransactions/PaymentHistory', [
                "PaymentHistoryData" =>  $this->salesAndTransactionsRepository->getPaymentHistory($request->mapped_transaction_id)->get(),
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function generateInvoice(Request $request)
    {
        ob_start('ob_gzhandler');
            return Inertia::render('SalesAndTransactions/Billing', [
                "TrasactionData" => $request->TrasactionData,
                "InvoiceData" => json_decode($request->InvoiceData),
                "PayorsData" => json_decode($request->PayorsData),
                "Demands" => json_decode($request->Demands),
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function payables(Request $request)
    {
        ob_start('ob_gzhandler');
        ob_end_flush();
    }

}
