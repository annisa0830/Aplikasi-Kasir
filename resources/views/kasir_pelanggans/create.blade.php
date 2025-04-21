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
        <h1 class="text-center mb-4">Tambah Pelanggan</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('kasir_pelanggans.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="Nama_Pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="char" class="form-control" id="Nama_Pelanggan" name="Nama_Pelanggan" placeholder="Masukkan nama pelanggan" required>
                    </div>
                    <div class="mb-3">
                        <label for="Alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="Alamat" name="Alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="Nomor_Telepon" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" id="Nomor_Telepon" name="Nomor_Telepon" placeholder="Masukkan nomor telepon" required>
                    </div>
                    <div class="text-center">
    <button type="submit" class="btn btn-primary">Tambah</button>
    <a href="{{ route('kasir_pelanggans.index') }}" class="btn btn-secondary ms-2">Kembali</a>
</div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
