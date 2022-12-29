<?php

namespace App\Http\Controllers;

use App\Traits\SmsTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserAccountsInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\User;
use App\Models\UserDetail;

class UserAccountsController extends Controller
{
    use SmsTrait;

    private UserAccountsInterface $userAccountsRepository;

    public function __construct(UserAccountsInterface $userAccountsRepository) 
    {
        $this->userAccountsRepository = $userAccountsRepository;
    }

    // Params: { perPage : int, type : 'farmer' or 'trader'  }
    public function userAccounts(Request $request) 
    {
        ob_start('ob_gzhandler');
            return Inertia::render('Users/UserList', [
                "UsersAccounts" => $this->userAccountsRepository->getUserAccountByType($request->type)->paginate($request->perPage)->appends($request->query()),
                "AccountType" => $request->type,
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function userAccountInfo(Request $request) // Params: { user_id : int, type : 'farmer' or 'trader' }
    {
        ob_start('ob_gzhandler');
            return Inertia::render('Users/UserProfile', [
                "UserAccountInfo" => $this->userAccountsRepository->getUserAccountByTypeAndId($request->user_id,$request->type)->get(),
                "AccountType" => $request->type,
                "RoutePrefix" => Route::current()->action['prefix'],
            ]);
        ob_end_flush();
    }

    public function approveUserAccount(Request $request) // Params: { user_id : int, }
    {
        ob_start('ob_gzhandler');
        if($this->userAccountsRepository->approveUserAccountByID($request->user_id) == 1){
            $user = UserDetail::where('user_id', $request->user_id)->first();
            $message = ucwords($user->fname).' '.ucwords($user->lname) .", your account has been approved by the AgriHub operator.";
            # Sending Message to Client - Uncomment this when testing or Deployment
            if($this->approvedSMSNotification($user->phone,$message)){
                return 1;
            }
            # Uncomment this when testing or Deployment
            // return 1;
        }else{
            return 0;
            
        }

        ob_end_flush();
    }
    


}
