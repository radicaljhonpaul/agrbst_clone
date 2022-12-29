<?php

use App\Http\Controllers\API\BidsAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\API\Crops;
use App\Http\Controllers\API\CropsAPI;
use App\Http\Controllers\API\DemandsAPI;
use App\Http\Controllers\API\Registration;
use App\Http\Controllers\API\Login;
use App\Http\Controllers\API\Logout;
use App\Http\Controllers\API\PostingOfDemands;
use App\Http\Controllers\API\SmsAPI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CropController;
use App\Http\Controllers\API\TraderController;
use App\Http\Controllers\API\FarmerController;
use App\Http\Controllers\API\AuthorizedPersonController;
use App\Http\Controllers\API\DemandController;
use App\Models\AuthorizedPerson;
use App\Http\Controllers\WidgetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/ 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// For API that needs authenticated middleware - auth:sanctum
Route::group(['middleware' => ['auth:sanctum']], function(){

    // Route for Authenticated Traders.
    Route::group(['middleware' => 'CheckType:trader', 'prefix' => 'trader'], function(){
        Route::get('/profile',[TraderController::class, 'showProfile']);
        Route::post('/profile/update',[TraderController::class, 'updateProfile']);
        Route::get('/profile/authorizedPerson',[AuthorizedPersonController::class, 'showProfile']);
        Route::post('/profile/authorizedPerson/update/{id}',[AuthorizedPersonController::class, 'updateAuthorizedPerson']);
        Route::post('/profile/authorizedPerson/delete/{id}',[AuthorizedPersonController::class, 'destroy_authorized_person']);
        Route::post('/demand/pre-order/checkout',[TraderController::class, 'checkout']);
        Route::get('/crops/details',[CropController::class, 'showCropDetails']);
        Route::get('/order/details',[TraderController::class, 'showOrderDetails']);
        Route::get('/transaction/history',[TraderController::class, 'transactionHistory']);
        Route::get('/transaction/history/details',[TraderController::class, 'transactionHistoryDetails']);



        Route::get('/widget',[WidgetController::class, 'demandOverCommitments']);
        Route::get('/widget/accounts',[WidgetController::class, 'accounts']);
        Route::get('/widget/inventory',[WidgetController::class, 'inventory']);
        

    });

    // Route for Authenticated Farmers.
    Route::group(['middleware' => 'CheckType:farmer', 'prefix' => 'farmer'], function(){
        Route::get('/profile/show',[FarmerController::class, 'showProfile']);
        Route::post('/profile/update/{id}',[FarmerController::class, 'updateProfile']);
        Route::get('/search',[FarmerController::class, 'search']);
        Route::get('/demands/commit-calculation',[FarmerController::class, 'commitCalculation']);
        Route::post('/demands/commit',[FarmerController::class, 'commit']);
        Route::post('/harvest-data',[FarmerController::class, 'harvestData']);
        Route::get('/my-commitments',[FarmerController::class, 'myCommitments']);
        Route::get('/sales',[FarmerController::class, 'sales']);
        Route::get('/deliveries',[FarmerController::class, 'deliveries']);
    });

    // search Crops
    Route::get('/search', [CropController::class, 'search']);


    

    // Create Demands Before Crate
    Route::post('/create/demands', [DemandsAPI::class, 'create_demands']);
    // Create Demands On Crate
    Route::post('/delete/specific/demands', [DemandsAPI::class, 'delete_specific_demands']);
    Route::post('/view/specific/demands/mycrate', [DemandsAPI::class, 'view_demands_my_crate']);
    // Create Demands after Crate
    Route::post('/check_out/demands', [DemandsAPI::class, 'check_out_crate']);
    // Create Invoice
    Route::post('/view/check_out/demands', [DemandsAPI::class, 'view_check_out_demands']);
    
    Route::post('/view/batch/ordered', [DemandsAPI::class, 'view_batch_ordered']);
    Route::post('/view/specific/batch/ordered_list', [DemandsAPI::class, 'view_specific_batch_ordered_list']);
    Route::post('/view/specific/demands/checked_out', [DemandsAPI::class, 'view_specific_demands']);
    
    // Bid to Demands
    Route::post('/view/all/demands', [DemandsAPI::class, 'view_all_demands']);
    Route::post('/bid/to/demands', [BidsAPI::class, 'bid_to_demands']);
    Route::post('/bid/get/recommendation', [BidsAPI::class, 'bid_recommendation']);

    Route::post('/view/bid/to/demands', [BidsAPI::class, 'view_bid_to_demands']);
    // $route->post('/add/bid/progress', [BidsAPI::class, 'add_progress']);

    Route::post('/logout/mobile', [Logout::class, 'logout']);
});

Route::post('/add/bid/progress', [BidsAPI::class, 'add_progress']);
Route::post('/view/bid/progress', [BidsAPI::class, 'view_progress']);





// PUBLIC ROUTES 

// SMS API
Route::post('/sms/registration/verification', [SmsAPI::class, 'verify_registration']);

// Registration API
Route::post('/registration/mobile', [Registration::class, 'mobile_registration']);

// Login for Farmer
Route::post('/login/mobile/farmer', [FarmerController::class, 'farmerLogin']);
// Login for Trader
Route::post('/login/mobile/trader', [TraderController::class, 'traderLogin']);

