<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Peminjaman;

class AdminController extends Controller
{
   
   

    public function index()
    {
        $totalBuku = Buku::count();
        $totalPeminjam = User::where('role', 'peminjam')->count();
        $totalBukuDipinjam = Peminjaman::where('StatusPeminjaman', 'dipinjam')->count();
        $totalBukuKembali = Peminjaman::where('StatusPeminjaman', 'dikembalikan')->count();

       
        $bukuTerbaru = Buku::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalPeminjam',
            'totalBukuDipinjam',
            'totalBukuKembali',
            'bukuTerbaru' 
        ));
    }
    
 
    public function store(Request $request)
    {
        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'Email' => 'required|email|unique:users',
            'Password' => 'required|min:6',
        ]);

        User::create([
            'namalengkap' => $request->namalengkap,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'role' => 'administrator',
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email,' . $id . ',UserID',
            'Password' => 'nullable|min:6',
        ]);

        $user->update([
            'namalengkap' => $request->namalengkap,
            'Email' => $request->Email,
            'Password' => $request->Password ? Hash::make($request->Password) : $user->Password,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

   
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }

    
    public function kategori()
    {
        return view('admin.kategori');
    }

 
    public function databuku()
    {
        return view('admin.databuku');
    }

    
    public function dataPeminjaman()
    {
        return view('admin.data_peminjaman');
    }

    public function peminjaman()
    {
        return view('admin.peminjaman');
    }
}
