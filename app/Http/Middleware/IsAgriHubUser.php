<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\User;

class IsAgriHubUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /** 
     * table - users
     * column - user_type 
     * value - agrihub (For agrihub users only)
     */
    public function handle(Request $request, Closure $next, string $role)
    {

        try {
            if(Auth::check()){
                if($role == 'Agrihub'){
                    if(auth()->user()->user_type == 'Agrihub'){
                        // return dd(auth()->user()->user_type);
                        return $next($request);
                    }
                    return Redirect::route('checkRole')->withErrors([
                        'message' => 'Restricted Access!',
                    ]);
                }
            }else{
                // Redirect to login
                return Redirect::route('login');
            }
        } catch (\Exception $e) {
            //throw $th;
            return Redirect::route('checkRole')->withErrors([
                'message' => $e->getMessage(),
            ]);
        }

        // if(Auth::check()){
        //     if($role == 'Agrihub'){
        //         if(auth()->user()->user_type == 'Agrihub'){
        //             // return dd(auth()->user()->user_type);
        //             return $next($request);
        //         }else{
        //             return Redirect::route('checkRole')->withErrors('Restricted Access!');
        //         }
        //     }
        //     return Redirect::route('checkRole')->withErrors('Restricted Access!');
        // }else{
        //     // Redirect to login
        //     return Redirect::route('login');
        // }
        // return $next($request);
    }
}
