<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ubah Pelanggan</title>
</head>
<h1>Edit Pelanggan</h1>

<form method="POST" action="{{ route('kasir_pelanggans.update', $kasir_pelanggan->PelangganID) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="Nama_Pelanggan">Nama Pelanggan</label>
        <input type="char" class="form-control" id="Nama_Pelanggan" name="Nama_Pelanggan" value="{{ $kasir_pelanggan->Nama_Pelanggan }}" required>
    </div>

    <div class="form-group">
        <label for="Alamat">Alamat</label>
        <input type="char" class="form-control" id="Alamat" name="Alamat" value="{{ $kasir_pelanggan->Alamat }}" required>
    </div>

    <div class="form-group">
        <label for="Nomor_Telepon">Nomor Telepon</label>
        <input type="text" class="form-control" id="Nomor_Telepon" name="Nomor_Telepon" value="{{ $kasir_pelanggan->Nomor_Telepon }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
