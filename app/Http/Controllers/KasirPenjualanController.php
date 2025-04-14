<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\KasirPenjualan;
use App\Models\DetailPenjualan;
use App\Models\KasirProduk;
use App\Models\KasirPelanggan;

class KasirPenjualanController extends Controller
{
    public function index()
    {
        $kasir_penjualans = KasirPenjualan::with('kasir_pelanggan')->paginate(10);
        return view('kasir_penjualans.index', compact('kasir_penjualans'));
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('Nama_Produk', 'LIKE', '%' . $search . '%')
                  ->orWhere('Harga', 'LIKE', '%' . $search . '%')
                  ->orWhere('Stok', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('kategori', function ($q) use ($search) {
                      $q->where('Nama_Kategori', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('penjualans', function ($q) use ($search) {
                      $q->whereHas('pelanggan', function ($q) use ($search) {
                          $q->where('Nama_Pelanggan', 'LIKE', "%{$search}%");
                      })
                      ->orWhere('Tanggal_Penjualan', 'LIKE', "%{$search}%")
                      ->orWhere('Total_Harga', 'LIKE', "%{$search}%");
                  });
            });
        }
    }

    public function create()
    {
        return view('kasir_penjualans.create', [
            'kasir_pelanggans' => KasirPelanggan::all(),
            'kasir_produks' => KasirProduk::all()
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'PelangganID' => 'required|exists:kasir_pelanggans,PelangganID',
        'Tanggal_Penjualan' => 'required|date',
        'Total_Harga' => 'required|numeric|min:0',
        'Uang_Bayar' => 'required|numeric|min:' . $request->Total_Harga, // Pastikan uang bayar tidak kurang
        'products' => 'required|array',
        'products.*.ProdukID' => 'required|exists:kasir_produks,ProdukID',
        'products.*.Kuantitas' => 'required|numeric|min:1',
    ]);

    // Format angka dengan benar sebelum menyimpan
    $Total_Harga = (float) str_replace('.', '', $request->Total_Harga);
    $Uang_Bayar = (float) str_replace('.', '', $request->Uang_Bayar);
    $Uang_Kembali = $Uang_Bayar - $Total_Harga;

    // Simpan data penjualan
    $kasir_penjualan = KasirPenjualan::create([
        'PelangganID' => $request->PelangganID,
        'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
        'Total_Harga' => $Total_Harga,
        'Uang_Bayar' => $Uang_Bayar,
        'Uang_Kembali' => $Uang_Kembali
    ]);

    $stok_kurang = [];
    foreach ($request->products as $product) {
        $produk = KasirProduk::findOrFail($product['ProdukID']);
        if ($produk->Stok < $product['Kuantitas']) {
            $stok_kurang[] = [
                'Nama_Produk' => $produk->Nama_Produk,
                'Stok' => $produk->Stok
            ];
        }
    }

    if (!empty($stok_kurang)) {
        $stok_info = [];
        foreach ($stok_kurang as $produk) {
            $stok_info[] = "{$produk['Nama_Produk']} (Sisa: {$produk['Stok']})";
        }

        return redirect()->back()->with(
            'error',
            'Stok tidak mencukupi untuk produk: ' . implode(', ', $stok_info)
        );
    }

    // Simpan detail penjualan dan update stok setelah stok dikonfirmasi cukup
    foreach ($request->products as $product) {
        DetailPenjualan::create([
            'PenjualanID' => $kasir_penjualan->PenjualanID,
            'ProdukID' => $product['ProdukID'],
            'Kuantitas' => $product['Kuantitas']
        ]);

        // Kurangi stok produk
        KasirProduk::where('ProdukID', $product['ProdukID'])
            ->decrement('Stok', $product['Kuantitas']);
    }

    return redirect()->route('kasir_penjualans.index')->with('success', 'Penjualan berhasil disimpan!');
}

    public function show($id)
    {
        $kasir_penjualan = KasirPenjualan::with('kasir_pelanggan', 'detail_penjualans.kasir_produk')->findOrFail($id);
    
        // Jika user mengklik "Cetak Struk"
        if (request()->has('pdf')) {
            $pdf = Pdf::loadView('kasir_penjualans.struk', compact('kasir_penjualan'));
            return $pdf->stream('struk_penjualan.pdf'); // Menampilkan di browser
        }
    
        return view('kasir_penjualans.show', compact('kasir_penjualan'));
    }
    

    public function edit($id)
    {
        $kasir_penjualan = KasirPenjualan::findOrFail($id);
        return view('kasir_penjualans.edit', [
            'kasir_penjualan' => $kasir_penjualan,
            'kasir_pelanggans' => KasirPelanggan::all(),
            'kasir_produks' => KasirProduk::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'PelangganID' => 'required|exists:kasir_pelanggans,PelangganID',
            'Tanggal_Penjualan' => 'required|date',
            'Total_Harga' => 'required|numeric|min:0',
            'Uang_Bayar' => 'required|numeric|min:0',
            'products' => 'required|array',
            'products.*.ProdukID' => 'required|exists:kasir_produks,ProdukID',
            'products.*.Kuantitas' => 'required|numeric|min:1',
        ]);

        $kasir_penjualan = KasirPenjualan::findOrFail($id);

        // Kembalikan stok produk lama sebelum update
        foreach ($kasir_penjualan->kasirDetailPenjualans as $detail) {
            KasirProduk::where('ProdukID', $detail->ProdukID)->increment('Stok', $detail->Kuantitas);
        }

        // Hapus detail penjualan lama
        $kasir_penjualan->kasirDetailPenjualans()->delete();

        // Update data penjualan
        $kasir_penjualan->update([
            'PelangganID' => $request->PelangganID,
            'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
            'Total_Harga' => $request->Total_Harga,
            'Uang_Bayar' => $request->Uang_Bayar,
            'Uang_Kembali' => $request->Uang_Bayar - $request->Total_Harga
        ]);

        // Simpan data produk yang baru
        foreach ($request->products as $product) {
            $produk = KasirProduk::findOrFail($product['ProdukID']);

            if ($produk->Stok < $product['Kuantitas']) {
                return redirect()->back()->with('error', "Stok produk $produk->Nama_Produk tidak mencukupi!");
            }

            DetailPenjualan::create([
                'PenjualanID' => $kasir_penjualan->PenjualanID,
                'ProdukID' => $product['ProdukID'],
                'Kuantitas' => $product['Kuantitas']
            ]);

            $produk->decrement('Stok', $product['Kuantitas']);
        }

        return redirect()->route('kasir_penjualans.index')->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kasir_penjualan = KasirPenjualan::findOrFail($id);

        if ($kasir_penjualan->detail_penjualans()->exists()) {
            foreach ($kasir_penjualan->detail_penjualans as $detail) {
                KasirProduk::where('ProdukID', $detail->ProdukID)->increment('Stok', $detail->Kuantitas);
            }
            $kasir_penjualan->detail_penjualans()->delete();
        }
        $kasir_penjualan->delete();

        return redirect()->route('kasir_penjualans.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}
