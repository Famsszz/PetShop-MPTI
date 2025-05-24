<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Nama_Akun' => 'required|string|max:50',
            'Nama_Pengguna' => ['required', 'min:3', 'max:50', 'unique:users'],
            'password' => 'required|min:3|max:255',
            'No_Telp' => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:50', 'unique:users'],
            'email' => 'required|email:dns|unique:users'
        ]);

        $user = User::create([
            'Nama_Akun' => $request->Nama_Akun,
            'Nama_Pengguna' => $request->Nama_Pengguna,
            'password' => Hash::make($request->password),
            'No_Telp' => $request->No_Telp,
            'email' => $request->email,
        ]);

        event(new Registered($user));

        Auth::login($user); 

        return redirect(RouteServiceProvider::HOME);
    }
}
