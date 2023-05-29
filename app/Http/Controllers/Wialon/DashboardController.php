<?php

namespace App\Http\Controllers\Wialon;

use App\Http\Controllers\Controller;
use App\Services\WialonService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->token;
        if($token){
            WialonService::login($token);
            info(['wialonSid' => session('wialonSid')]);
            return Inertia::render('Dashboard');
        }else{
            abort(401);
        }
    }
}
