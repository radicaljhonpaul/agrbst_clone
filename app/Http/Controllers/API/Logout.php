<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Logout extends Controller
{
    public function logout(Request $request){

        // Delete access token.
        // return User::find(Auth::id());
        // $User = User::find(Auth::id());
        // return $User->user_type;
        // return User::all();
        $res = request()->user()->currentAccessToken()->delete();
        if($res == 1){
            return response(['message' => 'Logged Out Successfully']);
        }
    }
}
