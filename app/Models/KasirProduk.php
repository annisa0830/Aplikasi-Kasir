<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KasirProduk;


class KasirProduk extends Model
{
    use HasFactory;

    protected $table = 'kasir_produks'; 
    protected $primaryKey = 'ProdukID'; 

    protected $fillable = [
        'KategoriID',
        'Nama_Produk', 
        'Harga',
        'Stok'
    ];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'KategoriID', 'KategoriID');
    }
    public function detail_Penjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'ProdukID', 'ProdukID');
    }
    
    
}
