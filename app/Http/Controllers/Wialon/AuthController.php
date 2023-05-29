<?php

namespace App\Http\Controllers\Wialon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function redirectWialon(){
        return redirect(
            config('wialon.base_url') .
            '/login_simple.html?lang=en&cms_url=' .
            config('wialon.redirect_url') .
            '&cms_title=' .
            config('app.name')
        );
    }
}
