<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan daftar admin
    public function indexAdmin()
    {
        $users = User::where('role', 'administrator')->get();
        return view('admin.dataadmin', compact('users'));
    }

    // Menampilkan daftar petugas
    public function indexPetugas()
    {
        $users = User::where('role', 'petugas')->get();
        return view('admin.datapetugas', compact('users'));
    }

    // Menampilkan daftar peminjam
    public function indexPeminjam()
    {
        $users = User::where('role', 'peminjam')->get();
        return view('admin.datapeminjam', compact('users'));
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'Email' => 'required|email|unique:users',
            'Password' => 'required|min:6',
            'role' => 'required|in:administrator,petugas,peminjam',
        ]);

        User::create([
            'namalengkap' => $request->namalengkap,
            'Email' => $request->Email,
            'Password' => bcrypt($request->Password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'User berhasil ditambahkan.');
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email,' . $id . ',UserID',
            'role' => 'required|in:administrator,petugas,peminjam',
            'Password' => 'nullable|min:6',
        ]);

        $data = [
            'namalengkap' => $request->namalengkap,
            'Email' => $request->Email,
            'role' => $request->role,
        ];

        // Jika ada password baru, update password
        if ($request->filled('Password')) {
            $data['Password'] = bcrypt($request->Password);
        }

        $user->update($data);

        return back()->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
