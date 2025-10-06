<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
     /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
     public function store(Request $request): RedirectResponse
    {
        $request->validate([
        'username' => ['required', 'string', 'max:50', 'unique:users,username'],
        'email'    => ['required', 'string', 'email', 'max:50', 'unique:users,email'],
        'fname'    => ['required', 'string', 'max:50'],
        'lname'    => ['required', 'string', 'max:50'],
        'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $user = User::create([
        'username' => $request->username,
        'fname'    => $request->fname,
        'lname'    => $request->lname,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // redirect to login page
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
