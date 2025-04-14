
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ubah Kategori</title>
</head>
<div class="container mt-4">
    <h1>Edit Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('kategoris.update', $kategori->KategoriID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Nama_Kategori" class="form-label">Nama Kategori:</label>
            <textarea class="form-control" name="Nama_Kategori" id="Nama_Kategori">{{ old('Nama_Kategori', $kategori->Nama_Kategori) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="Deskripsi" class="form-label">Deskripsi:</label>
            <textarea class="form-control" name="Deskripsi" id="Deskripsi">{{ old('Deskripsi', $kategori->Deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
