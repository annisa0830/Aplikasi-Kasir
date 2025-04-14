<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Models\KasirProduk;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ProdukID' => 'required|exists:kasir_produks,ProdukID',
            'Jumlah_Produk' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $produk = KasirProduk::findOrFail($request->ProdukID);

            // **Cek jika stok habis (0)**
            if ($produk->Stok == 0) {
                return back()->with('error', 'Produk ini sedang kosong! Harap restok terlebih dahulu.');
            }

            // **Cek apakah stok cukup**
            if ($produk->Stok < $request->Jumlah_Produk) {
                return back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $produk->Stok);
            }

            // **Hitung subtotal**
            $subtotal = $produk->Harga * $request->Jumlah_Produk;

            // **Simpan detail penjualan**
            DetailPenjualan::create([
                'PenjualanID' => 1, // Sesuaikan dengan sistem transaksi
                'ProdukID' => $produk->ProdukID,
                'Jumlah_Produk' => $request->Jumlah_Produk,
                'Subtotal' => $subtotal,
            ]);

            DB::commit();
            return back()->with('success', 'Transaksi berhasil! Stok diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
