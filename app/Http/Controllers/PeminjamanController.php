<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])->get();
        return view('admin.data_peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $buku = Buku::all();
        return view('admin.tambah_peminjaman', compact('users', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'UserID' => 'required|exists:users,UserID',
            'BukuID' => 'required|exists:buku,BukuID',
            'TanggalPeminjaman' => 'required|date',
            'StatusPeminjaman' => 'required|string|max:50',
        ]);

        Peminjaman::create([
            'UserID' => $request->UserID,
            'BukuID' => $request->BukuID,
            'TanggalPeminjaman' => $request->TanggalPeminjaman,
            'StatusPeminjaman' => $request->StatusPeminjaman,
        ]);

        return redirect()->route('admin.data.peminjaman')->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'StatusPeminjaman' => 'required|string|max:50',
            'TanggalPengembalian' => 'nullable|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'StatusPeminjaman' => $request->StatusPeminjaman,
            'TanggalPengembalian' => $request->TanggalPengembalian,
        ]);

        return redirect()->route('admin.data.peminjaman')->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        Peminjaman::findOrFail($id)->delete();
        return redirect()->route('admin.data.peminjaman')->with('success', 'Data peminjaman berhasil dihapus');
    }
}
