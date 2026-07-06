<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterWisatawanController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        // 2. Simpan ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, // Pastikan field ini sudah ada di migrasi table users
            'password' => Hash::make($request->password),
        ]);

        // 3. Login Otomatis
        Auth::login($user);

        // 4. Redirect ke Dashboard atau Home
        return redirect('/home')->with('success', 'Selamat Datang di Ngapak Adventure!');
    }
}
