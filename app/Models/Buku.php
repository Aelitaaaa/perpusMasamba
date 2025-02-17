<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'BukuID';
    public $timestamps = false;

    protected $fillable = [
        'Judul', 'Penulis', 'Penerbit', 'TahunTerbit', 'Stok', 'KategoriID', 'cover'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'KategoriID', 'KategoriID');
    }
}
