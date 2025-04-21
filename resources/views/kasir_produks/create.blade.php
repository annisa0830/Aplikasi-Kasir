@extends('tampilan')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk</title>
    <!-- Tambahkan link Bootstrap di sini -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Produk</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('kasir_produks.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                <label for="KategoriID">Nama Kategori</label>
                <select class="form-control" id="KategoriID" name="KategoriID" required>
                    <option value="">--Nama Kategori--</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->KategoriID }}">{{ $kategori->Nama_Kategori }}</option>
                    @endforeach
                </select>
            </div>
 <div class="mb-3">
    <label for="Nama_Produk" class="form-label">Nama Produk</label>
    <input type="text" class="form-control" id="Nama_Produk" name="Nama_Produk" placeholder="Masukkan nama produk" required>
</div>

<div class="mb-3">
    <label for="Harga" class="form-label">Harga</label>
    <input type="number" class="form-control" id="Harga" name="Harga" placeholder="Masukkan harga" required>
</div>

<div class="mb-3">
    <label for="Stok" class="form-label">Stok</label>
    <input type="number" class="form-control" id="Stok" name="Stok" placeholder="Masukkan stok" required>
</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary">Tambah</button>
    <a href="{{ route('kasir_produks.index') }}" class="btn btn-secondary ms-2">Kembali</a>
</div>


                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
