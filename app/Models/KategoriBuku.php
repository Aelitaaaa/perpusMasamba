<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;
    
    protected $table = 'kategoribuku'; 
        protected $primaryKey = 'KategoriID';
            public $timestamps = true;

    protected $fillable = ['NamaKategori'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'KategoriID', 'KategoriID');
    }
}
