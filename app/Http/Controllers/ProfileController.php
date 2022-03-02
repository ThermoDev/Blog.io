<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\BlogRepositoryInterface;

class ProfileController extends Controller
{
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index($userId)
    {
        $user = User::findOrFail($userId);

        $editable = false;

        if (auth()->user() && auth()->user()->id == $user->id) {
            $editable = true;
        }

        $blogs = $this->blogRepository->getAllUserBlogsByLatestWithPaginate(10, $user->id);

        return view('users.profile', [
            "bio" => $user->bio,
            "name" => $user->name,
            "editable" => $editable,
            "blogs" => $blogs
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('users.edit', [
            "bio" => $user->bio,
            "name" => $user->name
        ]);
    }

    public function updateBasicInfo(Request $request)
    {
        $this->validate($request, [
            'bio' => 'required_without_all:name|max:255',
            'name' => 'required_without_all:bio|max:255'
        ]);

        $user = auth()->user();

        if ($request->bio) {
            $user->bio = $request->bio;
            activity()->causedBy($user)->log("A user updated their bio to: $request->bio");
        }

        if ($request->name) {
            $user->name = $request->name;
            activity()->causedBy($user)->log("A user updated their name to: $request->name");
        }

        $user->save();

        return redirect()->route('profile', ["userId" => $user->id])->with('success', 'Profile info  successfully!');
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
