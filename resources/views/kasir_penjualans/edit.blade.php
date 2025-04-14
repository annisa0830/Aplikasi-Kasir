<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ubah Tempat</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Ubah Penjualan</h1>
        <form method="POST" action="{{ route('kasir_penjualans.update', $kasir_penjualan->PenjualanID) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="Tanggal_Penjualan">Tanggal Penjualan</label>
                <input type="date" class="form-control" id="Tanggal_Penjualan" name="Tanggal_Penjualan" value="{{ old('Tanggal_Penjualan', $kasir_penjualan->Tanggal_Penjualan) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="Total_Harga">Total Harga</label>
                <input type="number" class="form-control" id="Total_Harga" name="Total_Harga" value="{{ old('Total_Harga', $kasir_penjualan->Total_Harga) }}" required>
            </div>
            <div class="form-group">
            <label for="PelangganID">Nama Pelanggan</label>
            <select name="PelangganID" class="form-control" required>
                @foreach ($kasir_pelanggan as $kasir_pelanggan)
                    <option value="{{ $kasir_penjualan->PenjualanID }}">{{ $kasir_pelanggan->Nama_Pelanggan }}</option>
                @endforeach
            </select>
            
            <div class="row justify-content-end mt-2">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Ubah Data Penjualan</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('kasir_penjualans.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
