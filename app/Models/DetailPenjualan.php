<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPenjualan;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualans'; // Nama tabel yang digunakan

    protected $primaryKey = 'DetailID'; // Nama kolom sebagai primary key

    protected $fillable = [
        'PenjualanID',
        'ProdukID',
        'Kuantitas',
        
    ];

    public function kasir_penjualan()
    {
        return $this->belongsTo(KasirPenjualan::class, 'PenjualanID', 'PenjualanID');

    }
    public function kasir_produk()
    {
        return $this->belongsTo(KasirProduk::class, 'ProdukID', 'ProdukID');

    }
}
