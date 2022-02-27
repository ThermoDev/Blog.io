<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('users.register');
    }

    public function createUser(Request $request)
    {
        // Validate Request
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        // Create User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => 'Hi! I\'m new to Blog.io.',
            'password' => Hash::make($request->password),
        ]);

        // Sign User in
        auth()->attempt($request->only(['email', 'password']));

        // Redirect
        return redirect()->route('home');
    }
}
