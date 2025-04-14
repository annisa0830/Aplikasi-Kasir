<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasirProduk;
use App\Models\Kategori;
use app\Models\Penjualan;

class KasirProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = KasirProduk::query();

        // Cek jika pencarian diisi
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('Nama_Produk', 'LIKE', '%' . $search . '%')
                  ->orWhere('Harga', 'LIKE', '%' . $search . '%')
                  ->orWhere('Stok', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('kategori', function ($q) use ($search) {
                    $q->where('KategoriID', 'LIKE', "%{$search}%");
                });
            });
        }

        // Mengambil data produk dengan relasi kategori dan melakukan pagination
        $kasir_produk = $query->with('kategori')->paginate(10);

        // Passing data ke view
        return view('kasir_produks.index', compact('kasir_produk')); // Perbaiki di sini
    }
    public function beli(Request $request)
{
    $request->validate([
        'kasir_produk' => 'required|exists:kasir_produks,ProdukID', // Pastikan ProdukID ada
        'Jumlah_Produk' => 'required|integer|min:1',
    ]);

    return DB::transaction(function () use ($request) {
        // Ambil produk berdasarkan ProdukID
        $kasir_produk = KasirProduk::findOrFail($request->kasir_produk);

        // Cek apakah stok mencukupi
        if ($request->Jumlah_Produk > $kasir_produk->Stok) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // Ambil atau buat PenjualanID (pastikan ada method `getPenjualanID`)
        $penjualanID = $this->getPenjualanID();

        // Kurangi stok
        $kasir_produk->update([
            'Stok' => $kasir_produk->Stok - $request->Jumlah_Produk
        ]);

        // Simpan ke tabel detail_penjualans
        DetailPenjualan::create([
            'PenjualanID' => $kasir_penjualan->PenjualanID,
            'ProdukID' => $kasir_produk->Nama_Produk,
            'Jumlah_Produk' => $request->Jumlah_Produk,
            'Subtotal' => $kasir_produk->Harga * $request->Jumlah_Produk,
        ]);

        return back()->with('success', 'Pembelian berhasil, stok diperbarui.');
    });
}

private function getPenjualanID()
{
    return Penjualan::latest()->value('id') ?? 1; // Sesuaikan dengan sistem transaksi
}
public function restok(Request $request)
    {
        $kasir_produk = KasirProduk::find($request->ProdukID);
        if ($kasir_produk) {
            $kasir_produk->Stok += $request->Jumlah_Stok;
            $kasir_produk->save();
        }
        return redirect()->back()->with('success', 'Stok berhasil ditambahkan!');
    }
    public function create()
{
    $kategoris = Kategori::all();  // Mengambil semua data kategori
    return view('kasir_produks.create', compact('kategoris'));  // Mengirim variabel $kategoris ke view
}

    public function store(Request $request)
    {
        // Aturan validasi
        $rules = [
            'KategoriID' => 'required|exists:kategoris,KategoriID',
            'Nama_Produk' => 'required|max:32',
            'Harga' => 'required|numeric|min:1',
            'Stok' => 'required|integer|min:0',
        ];

        // Melakukan validasi
        $validated = $request->validate($rules);

        // Pastikan hanya data yang tervalidasi yang diteruskan ke model
        KasirProduk::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('kasir_produks.index')->with('success', 'Produk Berhasil Dibuat.');
    }

    public function edit($ProdukID)
    {
        $kasir_produk = KasirProduk::findOrFail($ProdukID);
        $kategori = Kategori::all();

        return view('kasir_produks.edit', compact('kasir_produk', 'kategori'));
    }

    public function update(Request $request, $ProdukID)
    {
       
        try {
            // Validasi input
            $rules = [
                'KategoriID' => 'required|exists:kategoris,KategoriID',
                'Nama_Produk' => 'required|max:32',
                'Harga' => 'required|numeric|min:1',
                'Stok' => 'required|integer|min:0',
            ];

            $this->validate($request, $rules);

            // Cari produk berdasarkan ID
            $kasir_produk = KasirProduk::findOrFail($ProdukID);

            // Update data produk
            $kasir_produk->update([
                'KategoriID' => $request->KategoriID,
                'Nama_Produk' => $request->Nama_Produk,
                'Harga' => $request->Harga,
                'Stok' => $request->Stok,

                
            ]);

            // Redirect dengan pesan sukses 
            return redirect()->route('kasir_produks.index')->with('success', 'Produk Berhasil Diperbarui.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kasir_produks.index')->with('error', 'Produk Tidak Ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('kasir_produks.index')->with('error', 'Terjadi Kesalahan Saat Memperbarui Produk.');
        }
    }

    public function destroy($id)
    {
        $kasir_produk = KasirProduk::findOrFail($id);
        $kasir_produk->delete();

        return redirect()->route('kasir_produks.index')->with('success', 'Produk Berhasil Dihapus.');
    }
}
