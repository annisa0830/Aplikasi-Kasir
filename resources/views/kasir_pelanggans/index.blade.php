@extends('tampilan')
@section('content')
<div class="container mt-4">
<h1>Pelanggan</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <div class="d-flex justify-content-between mb-2">
        @can('view-admin')

            <a href="{{ route('kasir_pelanggans.create') }}" class="btn btn-primary">Tambah Data Pelanggan</a>
            @endcan
            </div>
            <form action="{{ route('kasir_pelanggans.index') }}" method="GET" class="d-flex">
                <input type="text" class="form-control me-2" name="search" placeholder="Cari Pelanggan..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>

            <table class="table table-bordered text-center">
    <thead>
        <tr class="table-secondary">
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kasir_pelanggans as $pelanggan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pelanggan->Nama_Pelanggan }}</td>
                <td>{{ $pelanggan->Alamat }}</td>
                <td>{{ $pelanggan->Nomor_Telepon }}</td>
                @can('view-admin')
                <td>
                    <a href="{{ route('kasir_pelanggans.edit', $pelanggan->PelangganID) }}" class="btn btn-sm btn-info">Ubah</a>
                    <form action="{{ route('kasir_pelanggans.destroy', $pelanggan->PelangganID) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this name?')">Hapus</button>
                    </form>
                </td>
                @endcan
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
