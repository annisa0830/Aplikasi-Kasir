<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Produk</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Produk</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('kasir_produks.update', $kasir_produk->ProdukID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="KategoriID" class="form-label">Nama Kategori</label>
                        <select class="form-control" id="KategoriID" name="KategoriID" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->KategoriID }}" 
                                    {{ old('KategoriID', $kasir_produk->KategoriID) == $item->KategoriID ? 'selected' : '' }}>
                                    {{ $item->Nama_Kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('KategoriID')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Nama_Produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="Nama_Produk" name="Nama_Produk" 
                               value="{{ old('Nama_Produk', $kasir_produk->Nama_Produk) }}" required>
                        @error('Nama_Produk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="Harga" name="Harga" 
                               value="{{ old('Harga', $kasir_produk->Harga) }}" required>
                        @error('Harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="Stok" name="Stok" 
                               value="{{ old('Stok', $kasir_produk->Stok) }}" required>
                        @error('Stok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('kasir_produks.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
