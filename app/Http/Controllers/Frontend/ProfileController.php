<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show profile page
    public function show()
    {
        $user = Auth::user();
        $newsletter = Newsletter::first();
        return view('frontend.profile', compact('user', 'newsletter'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $user->id,
            'fname' => 'nullable|string|max:50',
            'lname' => 'nullable|string|max:50',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            // old image remove
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            // new img save
            $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $request->file('profile_image')->move(public_path('img'), $imageName);

            // database path (img/filename)
            $user->profile_image = 'img/' . $imageName;

        } elseif ($request->remove_photo == "1") {
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }
            $user->profile_image = null;
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->fname = $request->fname;
        $user->lname = $request->lname;

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
