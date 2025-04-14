@extends('tampilan')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-primary">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0 text-white">Data Penjualan</h3>
        </div>
        <div class="card-body bg-light">
            
            <!-- Notifikasi sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Script untuk menghilangkan alert otomatis -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let alertElement = document.querySelector('.alert');
                    if (alertElement) {
                        setTimeout(() => {
                            alertElement.classList.add('fade');
                            setTimeout(() => alertElement.remove(), 500);
                        }, 2000);
                    }
                });
            </script>

            <!-- Tombol Tambah Penjualan -->
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('kasir_penjualans.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Penjualan
                </a>
            </div>

            <!-- Form Pencarian -->
            <form action="{{ route('kasir_penjualans.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari......" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>

            <!-- Tabel Data Penjualan -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th style="white-space: nowrap;">Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Uang Bayar</th>
                            <th>Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kasir_penjualans as $key => $penjualan)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td style="white-space: nowrap;">{{ $penjualan->Tanggal_Penjualan }}</td>
                                <td>
                                    {{ $penjualan->kasir_pelanggan->Nama_Pelanggan ?? '-' }}
                                </td>
                                <td class="text-start">
                                    @if($penjualan->detail_penjualans->isNotEmpty() && $penjualan->detail_penjualans->first()->kasir_produk)
                                        <ul class="mb-0">
                                            @foreach($penjualan->detail_penjualans as $detail)
                                                @if($detail->kasir_produk)
                                                    <li>{{ $detail->kasir_produk->Nama_Produk }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td>{{ $penjualan->detail_penjualans->sum('Kuantitas') ?? 0 }}</td>
                                <td>Rp {{ number_format($penjualan->Total_Harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($penjualan->Uang_Bayar, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($penjualan->Uang_Kembali, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('kasir_penjualan.show', $penjualan->PenjualanID) }}" class="btn btn-primary btn-sm">Struk</a>
                                    <form action="{{ route('kasir_penjualans.destroy', $penjualan->PenjualanID) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn btn-sm btn-info">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $kasir_penjualans->links('pagination::simple-bootstrap-4') }}
            </div>

        </div>
    </div>
</div>
@endsection
