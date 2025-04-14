<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Models\KasirPenjualan;
use App\Models\KasirProduk;

class DetailPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = DetailPenjualan::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('Nama_Produk', 'LIKE', '%' . $search . '%')
                  ->orWhere('Tanggal_Penjualan', 'LIKE', '%' . $search . '%')
                  ->orWhere('Jumlah_Produk', 'LIKE', '%' . $search . '%')
                  ->orWhere('Subtotal', 'LIKE', '%' . $search . '%');
            });
        }
        $detail_penjualan = DetailPenjualan::paginate(10); // Ganti get() dengan paginate()

        return view('detail_penjualans.index', compact('detail_penjualan'));
    }
    public function show($id)
    {
        $detail_penjualan = DetailPenjualan::findOrFail($id);
        return view('detail_penjualans.show', compact('detail_penjualan'));
    }
    public function create()
    {
        // $detail_penjualan = DetailPenjualan::findOrFail($id);
        $kasir_penjualan = KasirPenjualan::all();
        $kasir_produk = KasirProduk::all();

        return view('detail_penjualans.create', compact('kasir_penjualan', 'kasir_produk'));
    }
    public function store(Request $request)
{
    $rules = [
        'PenjualanID' => 'required|exists:kasir_penjualans,PenjualanID', 
        'ProdukID' => 'required|exists:kasir_produks,ProdukID', 
        'Jumlah_Produk' => 'required|integer|min:0', 
        'Subtotal' => 'required|numeric|min:1',   
    ];

    $validatedData = $request->validate($rules);

$kasir_produk = KasirProduk::find($request->ProdukID);

if (!$kasir_produk || $kasir_produk->Stok <= 0) {
    return redirect()->back()->with('error', 'Produk ini sedang habis dan tidak bisa ditambahkan!');
}

Detailpenjualan::create($validatedData);

return redirect()->route('detail_penjualans.index')->with('success', 'Detail berhasil ditambahkan.');

}
public function edit($id)
    {
        $detail_penjualan = DetailPenjualan::findOrFail($id);
        $kasir_penjualan = KasirPenjualan::all();
        $kasir_produk = KasirProduk::all();

        return view('detail_penjualans.edit', compact('detail_penjualan', 'kasir_penjualan', 'kasir_produk'));
    }
    public function update(Request $request, $id)
{
    // Aturan validasi
    $rules = [
        'PenjualanID' => 'required|exists:kasir_penjualans,PenjualanID', 
        'ProdukID' => 'required|exists:kasir_produks,ProdukID', 
        'Jumlah_Produk' => 'required|integer|min:0', 
        'Subtotal' => 'required|numeric|min:1',   
    ];

    // Validasi data
    $validatedData = $request->validate($rules);

    // Cari data berdasarkan ID
    $detail_penjualan = DetailPenjualan::findOrFail($id);

    // Perbarui data di database
    $detail_penjualan->update($validatedData);

    // Redirect ke index dengan pesan sukses
    return redirect()->route('detail_penjualans.index')
                     ->with('success', 'Detail Berhasil Diperbarui.');
}
public function destroy($id)
    {
        $detail_penjualan = DetailPenjualan::findOrFail($id);
        $detail_penjualan->delete();

        return redirect()->route('detail_penjualans.index')->with('success', 'Penjualan Berhasil Dihapus.'); 
    }
}