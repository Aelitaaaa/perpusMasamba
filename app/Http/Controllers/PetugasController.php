<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PetugasController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'petugas')->get();
        return view('admin.datapetugas', compact('users'));
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
            'Password' => bcrypt($request->Password),
            'role' => 'petugas',
        ]);

        return redirect()->back()->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'namalengkap' => $request->namalengkap,
            'Email' => $request->Email,
            'Password' => $request->Password ? bcrypt($request->Password) : $user->Password,
        ]);

        return redirect()->back()->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Petugas berhasil dihapus.');
    }
}
