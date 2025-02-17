<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
 
    public function showLogin()
    {
        return view('auth.login');
    }

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
            return redirect('/admin/dashboard')->with('success', 'Login berhasil!');
        } elseif ($user->role == 'petugas') {
            return redirect('/petugas/dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect('/peminjam/dashboard')->with('success', 'Login berhasil!');
        }
    }

    return back()->withErrors(['email' => 'Email atau password salah!']);
}
  
    public function showRegister()
    {
        return view('auth.register');
    }

 
    public function register(Request $request)
    {
        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|min:6|confirmed',
            'role' => 'required|in:administrator,petugas,peminjam',
            'Alamat' => 'nullable|string',
        ]);
    
        $user = User::create([
            'namalengkap' => $request->namalengkap,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password), 
            'role' => $request->role,
            'Alamat' => $request->Alamat,
        ]);
    
        Auth::login($user);
    
        return redirect('/')->with('success', 'Registrasi berhasil!');
    }
   
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout!');
    }


    public function showProfile()
{
    $user = Auth::user(); 
    return view('profile.index', compact('user')); 
}

public function editProfile()
{
    $user = Auth::user();
    return view('profile.edit-profile', compact('user')); 
}

public function updateProfile(Request $request)
{
    $request->validate([
        'namalengkap' => 'required|string|max:255',
        'email' => 'required|email',
        'alamat' => 'nullable|string',
    ]);

    $user = Auth::user();
    $user->update([
        'namalengkap' => $request->namalengkap,
        'Email' => $request->email,
        'Alamat' => $request->alamat,
    ]);

    return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui!');
}

}
