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

        $messages = [
            'birthdate.before' => 'You must be at least 18 years old to sign up.',
        ];

        // Validate Request
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
            'birthdate' => 'required|date|before:-18 years',
        ], $messages);

        // Create User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => 'Hi! I\'m new to Blog.io.',
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate
        ]);

        // Sign User in
        auth()->attempt($request->only(['email', 'password']));

        activity()->causedBy($user)->log("A user registered to blog.io!");

        // Redirect
        return redirect()->route('home');
    }
}
