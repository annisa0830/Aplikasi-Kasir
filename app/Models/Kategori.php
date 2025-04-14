<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris'; 

    protected $primaryKey = 'KategoriID'; 

    protected $fillable = [
        'Nama_Kategori', 
        'Deskripsi',
    ];
    public function kasir_produks()
    {
        return $this->hasMany(KasirProduk::class, 'KategoriID', 'KategoriID');

    }
}
