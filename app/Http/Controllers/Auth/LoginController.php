<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       
        $credentials = $request->only('email', 'password');

       
        if (Auth::attempt($credentials)) {
           
            return redirect()->intended('/index')->with('success', 'Berhasil Login!');
        }
        dd(Auth::attempt($credentials), $credentials);

        return redirect()->back()->with('error', 'Username atau Password Salah');
    }
    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil Logout!');
    }
}

