<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        
        \Log::info('Data Registrasi:', $request->all());

      
        $validatedData = $request->validate([
            'namalengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,Email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:administrator,petugas,peminjam',  
            'alamat' => 'nullable|string|max:255',
        ]);

     
        $user = User::create([
            'namalengkap' => $validatedData['namalengkap'],
            'Email' => $validatedData['email'], 
            'Password' => Hash::make($validatedData['password']), 
            'role' => $validatedData['role'], 
            'Alamat' => $validatedData['alamat'] ?? '', 
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
