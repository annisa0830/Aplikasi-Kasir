<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KasirPenjualan;
use App\Models\KasirPelanggan;
use App\Models\DetailPenjualan;

class KasirPenjualan extends Model
{
    use HasFactory;
    protected $table = 'kasir_penjualans'; // Nama tabel yang digunakan

    protected $primaryKey = 'PenjualanID'; // Nama kolom sebagai primary key

    protected $fillable = [
        'PelangganID',
        'Tanggal_Penjualan',
        'Total_Harga',
        'Uang_Bayar',
        'Uang_Kembali',
        
    ];
    public function kasir_pelanggan()
    {
        return $this->belongsTo(KasirPelanggan::class, 'PelangganID', 'PelangganID');

    }
    public function detail_penjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'PenjualanID', 'PenjualanID');

    }


}
