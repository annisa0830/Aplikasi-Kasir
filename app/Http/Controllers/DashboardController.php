<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KasirPelanggan;
use App\Models\KasirProduk;
use App\Models\KasirPenjualan;
class DashboardController extends Controller
{
public function index()
{
    $totalKategori = Kategori::count();
    $totalPelanggan = KasirPelanggan::count();
    $totalProduk = KasirProduk::count();
    $totalPenjualan = KasirPenjualan::sum('total_harga'); // Sesuaikan dengan nama kolom harga

    return view('dashboard', compact('totalKategori', 'totalPelanggan', 'totalProduk', 'totalPenjualan'));
    
}

}


