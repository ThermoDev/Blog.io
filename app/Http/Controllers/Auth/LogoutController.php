<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function deauthenticate()
    {

        $user = auth()->user();
        activity()->causedBy($user)->log("A user logged out.");

        auth()->logout();

        return redirect()->route('home');
    }
}
