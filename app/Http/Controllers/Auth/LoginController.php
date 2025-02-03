<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class LoginController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        $user = User::where('Email', $request->email)->first();

        
        if ($user && Hash::check($request->password, $user->Password)) {
            
            Auth::login($user);

           
            if ($user->role == 'administrator') {
                return redirect('/admin/dashboard');
            } elseif ($user->role == 'petugas') {
                return redirect('/petugas/dashboard');
            } else {
                return redirect('/');  
            }
        }

        
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
