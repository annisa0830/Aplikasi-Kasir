@extends('tampilan')
@section('content')
<div class="container mt-4">
<h1>Kategori</h1>
   
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('kategoris.create') }}" class="btn btn-primary">Tambah Kategori</a>
            </div>
            <form action="{{ route('kategoris.index') }}" method="GET" class="d-flex">
                <input type="text" class="form-control me-2" name="search" placeholder="Cari kategori..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>

            <table class="table table-bordered text-center">
    <thead>
        <tr class="table-secondary">
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kategoris as $kategori)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->Nama_Kategori }}</td>
                <td>{{ $kategori->Deskripsi }}</td>
                <td>
                    <a href="{{ route('kategoris.edit', $kategori->KategoriID) }}" class="btn btn-sm btn-info">Ubah</a>
                    <form action="{{ route('kategoris.destroy', $kategori->KategoriID) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('MAO DI APUS NI?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
    