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
            $login = WialonService::login($token);
            if($login){
                $request->session()->regenerate();
                return Inertia::render('Dashboard');
            }else{
                return response()->json(WialonService::$error);
            }
        }elseif(auth()->user()){
            return Inertia::render('Dashboard');
        }else{
            abort(401);
        }
    }

}
