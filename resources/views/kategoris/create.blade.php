<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori</title>
    <!-- Tambahkan link Bootstrap di sini -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Kategori</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('kategoris.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="Nama_Kategori" class="form-label">Kategori</label>
                        <textarea class="form-control" id="Nama_Kategori" name="Nama_Kategori" placeholder="Masukkan Kategori" nullable></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="Deskripsi" name="Deskripsi" placeholder="Masukkan Deskripsi" nullable></textarea>
                    </div>
                    
                    <div class="text-center">
    <button type="submit" class="btn btn-primary">Tambah</button>
    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary ms-2">Kembali</a>
</div>

                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
