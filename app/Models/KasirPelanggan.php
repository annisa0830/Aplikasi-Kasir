<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KasirPelanggan;
class KasirPelanggan extends Model
{
    use HasFactory;
    protected $table = 'kasir_pelanggans'; 

    protected $primaryKey = 'PelangganID'; 

    protected $fillable = [
        'Nama_Pelanggan', 
        'Alamat',
        'Nomor_Telepon'
    ];
    public function kasir_pelanggan()
    {
        return $this->hasMany(KasirPelanggan::class, 'PelangganID', 'PelangganID');

    }
    
}
