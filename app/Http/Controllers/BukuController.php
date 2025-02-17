<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        $kategori = KategoriBuku::all();
        return view('admin.databuku', compact('buku', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Judul' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'Penerbit' => 'required|string|max:255',
            'TahunTerbit' => 'required|integer',
            'Stok' => 'required|integer|min:1',
            'KategoriID' => 'required|exists:kategoribuku,KategoriID',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $coverPath = $request->hasFile('cover') 
            ? $request->file('cover')->store('covers', 'public') 
            : null;

        Buku::create([
            'Judul' => $request->Judul,
            'Penulis' => $request->Penulis,
            'Penerbit' => $request->Penerbit,
            'TahunTerbit' => $request->TahunTerbit,
            'Stok' => $request->Stok,
            'KategoriID' => $request->KategoriID,
            'cover' => $coverPath,
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, $BukuID)
    {
        $buku = Buku::findOrFail($BukuID);
    
        $validatedData = $request->validate([
            'Judul' => 'required',
            'Penulis' => 'required',
            'Penerbit' => 'required',
            'TahunTerbit' => 'required|integer',
            'Stok' => 'required|integer',
            'KategoriID' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validatedData['cover'] = $path;
        }
    
        $buku->update($validatedData);
    
        return redirect()->back()->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($BukuID)
    {
        $buku = Buku::findOrFail($BukuID);
        if ($buku->cover) Storage::disk('public')->delete($buku->cover);
        $buku->delete();
        return redirect()->back()->with('success', 'Buku berhasil dihapus.');
    }
}
