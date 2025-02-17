<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBuku;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategori = KategoriBuku::all();
        return view('admin.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaKategori' => 'required|string|max:255|unique:kategoribuku,NamaKategori',
        ]);

        KategoriBuku::create([
            'NamaKategori' => $request->NamaKategori,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'NamaKategori' => 'required|string|max:255|unique:kategoribuku,NamaKategori,'.$id.',editNamaKategori',
        ]);

        $kategori = KategoriBuku::findOrFail($id);
        $kategori->update(['NamaKategori' => $request->NamaKategori]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        KategoriBuku::destroy($id);
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
