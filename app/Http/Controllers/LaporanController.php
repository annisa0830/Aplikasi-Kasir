<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasirPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil data penjualan berdasarkan rentang tanggal
        $kasir_penjualans = KasirPenjualan::with(['kasir_pelanggan', 'detail_penjualans.kasir_produk'])
            ->whereBetween('Tanggal_Penjualan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->orderBy('Tanggal_Penjualan', 'desc')
            ->get();

        // Buat variabel tanggal
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;

        // Buat PDF
        $pdf = PDF::loadView('laporan.cetak', compact('kasir_penjualans', 'tanggal_mulai', 'tanggal_selesai'));

        return $pdf->download('laporan_penjualan.pdf');
    }
}
