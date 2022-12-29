<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\User;

class IsCaGoUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        try {
            if(Auth::check()){
                if($role == 'CaGo'){
                    if(auth()->user()->user_type == 'CaGo'){
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

        // return $next($request);
    }
}
