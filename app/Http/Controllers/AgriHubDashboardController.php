<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AgriHubDashboardController extends Controller
{
    public function index(Request $request)
    {
        ob_start('ob_gzhandler');
            return Inertia::render('Dashboard/AgriHub');
        ob_end_flush();
    }
}
