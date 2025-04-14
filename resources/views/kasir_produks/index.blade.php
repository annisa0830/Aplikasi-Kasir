@extends('tampilan')

@section('content')
<div class="container mt-4">
    <h1>Produk</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <div class="d-flex justify-content-between mb-2">
        @can('view-admin')
            <a href="{{ route('kasir_produks.create') }}" class="btn btn-primary">Tambah produk</a>
@endcan
            <form action="{{ route('kasir_produks.index') }}" method="GET" class="d-flex">
                <input type="text" class="form-control me-2" name="search" placeholder="Cari Produk..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kasir_produk as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->kategori->Nama_Kategori ?? '-' }}</td>
                        <td>{{ $produk->Nama_Produk }}</td>
                        <td>Rp. {{ number_format($produk->Harga, 0, ',', '.') }}</td>
                        <td>
                            @if ($produk->Stok == 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif ($produk->Stok < 5)
                                <span class="badge bg-warning">Hampir Habis ({{ $produk->Stok }})</span>
                            @else
                                <span class="badge bg-success">{{ $produk->Stok }}</span>
                            @endif
                        </td>
                        @can('view-admin')
                        <td>
                            
                            <a href="{{ route('kasir_produks.edit', $produk->ProdukID) }}" class="btn btn-sm btn-info">Ubah</a>
                            <form action="{{ route('kasir_produks.destroy', $produk->ProdukID) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('SERIUS DIAPUS NI?')">Hapus</button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Form Restok (hanya satu kali di bawah tabel) -->
       
    </div>
</div>
@endsection
