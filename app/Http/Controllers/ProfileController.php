<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('users.profile', [
            "bio" => $user->bio
        ]);
    }

    public function updateBio(Request $request)
    {
        $this->validate($request, [
            'bio' => 'required|max:255'
        ]);

        $user = auth()->user();

        $user->bio = $request->bio;
        $user->save();

        activity()->causedBy($user)->log("A user updated their bio to: $request->bio");

        return back()->with('success', 'Bio changed successfully!');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = auth()->user();

        if (!(Hash::check($request->old_password, $user->password))) {
            return back()->with('msg', 'The password you entered does not match with the current password.');
        }

        if (!strcmp($request->old_password, $request->new_password)) {
            return back()->with('msg', 'New password cannot be same as your current password.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        activity()->causedBy($user)->log("A user updated their password.");

        return back()->with('success', 'Password changed successfully!');
    }
}
