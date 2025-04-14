@extends('tampilan')
@section('content')
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container mt-5">
        <h1>Detail</h1>

        <div class="table-responsive">
            <!-- Tombol Tambah Data dan Form Pencarian -->
            <div class="d-flex justify-content-between mb-2">
                <a href="{{ route('detail_penjualans.create') }}" class="btn btn-primary">Tambah Data Detail</a>
                <form action="{{ route('detail_penjualans.index') }}" method="GET" class="d-flex">
                    <input type="text" class="form-control me-2" name="search" placeholder="Cari Detail..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tabel Data Penjualan -->
            <table class="table table-bordered table-striped text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Penjualan </th>
                        <th>Nama Produk </th>
                        <th>Jumlah Produk</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detail_penjualan as $detail_penjualans)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail_penjualans->kasir_penjualan->Tanggal_Penjualan ?? '-' }}</td>
                            <td>{{ $detail_penjualans->kasir_produk->Nama_Produk ?? '-' }}</td>
                            <td>{{ $detail_penjualans->Jumlah_Produk }}</td>
                            <td>Rp. {{ number_format($detail_penjualans->Subtotal, 3, '.', '.') }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('detail_penjualans.edit', $detail_penjualans->DetailID) }}" 
                                   class="btn btn-sm btn-info me-2">
                                   Ubah
                                </a>
                                <a href="{{ route('detail_penjualans.show', $detail_penjualans->DetailID) }}" class="btn btn-info btn-sm">lihat</a>
                                <form action="{{ route('detail_penjualans.destroy', $detail_penjualans->DetailID) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>
@endsection