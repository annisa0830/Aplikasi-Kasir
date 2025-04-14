<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasirPelanggan;

class KasirPelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = KasirPelanggan::query();

        // Cek jika pencarian diisi
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('Nama_Pelanggan', 'LIKE', '%' . $search . '%')
                  ->orWhere('Alamat', 'LIKE', '%' . $search . '%')
                  ->orWhere('Nomor_Telepon', 'LIKE', '%' . $search . '%');
            });
        }

        
        $kasir_pelanggans = $query->paginate(10);

    // Passing data ke view
    return view('kasir_pelanggans.index', compact('kasir_pelanggans'));
}

    public function create()
    {
        return view('kasir_pelanggans.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'Nama_Pelanggan' => 'required|max:32',
            'Alamat' => 'required',
            'Nomor_Telepon' => 'required|max:15',
        ];

        $this->validate($request, $rules);

        // Pastikan model yang digunakan benar
        KasirPelanggan::create($request->all());

        return redirect()->route('kasir_pelanggans.index')->with('success', 'Pelanggan Berhasil Dibuat.');
    }

    public function edit($id)
    {
        $kasir_pelanggan = KasirPelanggan::findOrFail($id);
        return view('kasir_pelanggans.edit', compact('kasir_pelanggan'));    
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'Nama_Pelanggan' => 'required|max:32',
                'Alamat' => 'required',
                'Nomor_Telepon' => 'required|max:15',
            ];

            $this->validate($request, $rules);

            $kasir_pelanggan = KasirPelanggan::findOrFail($id);
            $kasir_pelanggan->update($request->only(['Nama_Pelanggan', 'Alamat', 'Nomor_Telepon']));

            return redirect()->route('kasir_pelanggans.index')->with('success', 'Pengguna Berhasil Diperbarui.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kasir_pelanggans.index')->with('error', 'Pengguna Tidak Ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('kasir_pelanggans.index')->with('error', 'Terjadi Kesalahan Saat Memperbarui Pengguna.');
        }
    }

    public function destroy($id)
    {
        $kasir_pelanggan = KasirPelanggan::findOrFail($id);
        $kasir_pelanggan->delete();

        return redirect()->route('kasir_pelanggans.index')->with('success', 'Pelanggan Berhasil Dihapus.');
    }
}
