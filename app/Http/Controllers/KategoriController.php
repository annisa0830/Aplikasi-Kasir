<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Kategori::query();

        // Cek jika pencarian diisi
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('Nama_Kategori', 'LIKE', '%' . $search . '%')
                  ->orWhere('Deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        $kategoris = $query->paginate(10);

        // Passing data ke view
        return view('kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategoris.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'Nama_Kategori' => 'required|max:95',
            'Deskripsi' => 'nullable',
        ];

        $this->validate($request, $rules);

        // Pastikan model yang digunakan benar
        Kategori::create($request->all());

        return redirect()->route('kategoris.index')->with('success', 'Kategori Berhasil Dibuat.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategoris.edit', compact('kategori'));    
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'Nama_Kategori' => 'required|max:95',
                'Deskripsi' => 'nullable',
            ];
            $this->validate($request, $rules);

            $kategoris = Kategori::findOrFail($id);
            $kategoris->update($request->only(['Nama_Kategori', 'Deskripsi']));

            return redirect()->route('kategoris.index')->with('success', 'Kategori Berhasil Diperbarui.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kategoris.index')->with('error', 'Kategori Tidak Ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('kategoris.index')->with('error', 'Terjadi Kesalahan Saat Memperbarui Kategori.');
        }
    }

    public function destroy($id)
    {
        $kategoris = Kategori::findOrFail($id);
        $kategoris->delete();

        return redirect()->route('kategoris.index')->with('success', 'Kategori Berhasil Dihapus.');
    }
}
