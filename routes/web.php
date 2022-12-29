<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controller Classes
use App\Http\Controllers\AgriHubDashboardController;
use App\Http\Controllers\CaGoDashboardController;
use App\Http\Controllers\CommoditiesAndPricingController;
use App\Http\Controllers\InventoryAndOrdersController;
use App\Http\Controllers\SalesAndTransactionsController;
use App\Http\Controllers\SupplyAndDemandController;
use App\Http\Controllers\UserAccountsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    // return Inertia::render('Auth/Login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){

    // Middleware for auth pages
    Route::inertia('/checkRole', 'CheckRole')->name('checkRole');
	
    Route::group(['prefix' => 'Agrihub', 'as' => 'Agrihub.', 'middleware' => ['IsAgriHubUser:Agrihub']], function(){
        Route::get('/', [AgriHubDashboardController::class, 'index'])->name('AgriHubDashboardIndex');

        // User Accounts
        Route::get('/UserAccounts', [UserAccountsController::class, 'userAccounts'])->name('UserAccounts');
        Route::get('/UserAccountInfo', [UserAccountsController::class, 'userAccountInfo'])->name('UserAccountInfo');
        Route::post('/ApproveUserAccount', [UserAccountsController::class, 'approveUserAccount'])->name('ApproveUserAccount');
        Route::post('/ApproveUser', [UserAccountsController::class, 'approveUser'])->name('ApproveUser');
        
        // Supply and Demands
        Route::get('/SupplyAndDemands', [SupplyAndDemandController::class, 'index'])->name('SupplyAndDemandsIndex');
        Route::get('/SupplyAndDemands/SpecificSupplyAndDemands', [SupplyAndDemandController::class, 'specificSupplyAndDemands'])->name('SpecificSupplyAndDemands');
        Route::get('/SupplyAndDemands/SupplyAndDemandCalendar', [SupplyAndDemandController::class, 'getCalendarView'])->name('SupplyAndDemandCalendar');
        Route::get('/SupplyAndDemands/SupplyAndDemandCalendar/PerDate', [SupplyAndDemandController::class, 'getCalendarViewPerDate'])->name('SupplyAndDemandCalendarPerDate');
        Route::post('/ApproveCommit', [SupplyAndDemandController::class, 'approveCommit'])->name('ApproveCommit');
        Route::post('/DisApproveCommit', [SupplyAndDemandController::class, 'disApproveCommit'])->name('DisApproveCommit');
        
        // Sales and Transactions
        Route::get('/SalesAndTransactions', [SalesAndTransactionsController::class, 'index'])->name('SalesAndTransactionsIndex');
        Route::get('/SalesAndTransactions/PaymentHistory', [SalesAndTransactionsController::class, 'paymentHistory'])->name('PaymentHistory');
        Route::get('/SalesAndTransactions/PaymentHistory/Invoice', [SalesAndTransactionsController::class, 'generateInvoice'])->name('Invoice');
        Route::get('/Payables', [SalesAndTransactionsController::class, 'payables'])->name('Payables');
        
        // Inventory
        Route::get('/InventoryAndOrders', [InventoryAndOrdersController::class, 'index'])->name('InventoryAndOrders');
        Route::get('/InventoryAndOrders/PerMonth', [InventoryAndOrdersController::class, 'getPerMonth'])->name('InventoryAndOrdersPerMonth');
        Route::get('/InventoryAndOrders/PerDate', [InventoryAndOrdersController::class, 'getPerDate'])->name('InventoryAndOrdersPerDate');

        // Crops and Prices
        Route::get('/CommoditiesAndPricing', [CommoditiesAndPricingController::class, 'commoditiesAndPricing'])->name('CommoditiesAndPricing');
        Route::get('/SpecificCommoditiesAndPricing', [CommoditiesAndPricingController::class, 'specificCommoditiesAndPricing'])->name('SpecificCommoditiesAndPricing');

    });

    Route::group(['prefix' => 'CaGo', 'as' => 'CaGo.', 'middleware' => ['IsCaGoUser:CaGo']], function(){
        Route::get('/', [CaGoDashboardController::class, 'index'])->name('CaGoDashboardIndex');

        // User Accounts
        Route::get('/UserAccounts', [UserAccountsController::class, 'userAccounts'])->name('UserAccounts');
        Route::get('/UserAccountInfo', [UserAccountsController::class, 'userAccountInfo'])->name('UserAccountInfo');
        Route::post('/ApproveUserAccount', [UserAccountsController::class, 'approveUserAccount'])->name('ApproveUserAccount');

        // Activities

    });
});
