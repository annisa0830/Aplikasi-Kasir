<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    <p style="text-align: center;">Periode: {{ $tanggal_mulai }} - {{ $tanggal_selesai }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kasir_penjualans as $index => $penjualan)
                @foreach($penjualan->detail_penjualans as $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penjualan->Tanggal_Penjualan }}</td>
                        <td>{{ $penjualan->kasir_pelanggan->Nama_Pelanggan ?? 'Tidak Ada' }}</td>
                        <td>{{ $detail->kasir_produk->Nama_Produk ?? 'Tidak Ada' }}</td>
                        <td>{{ $detail->Kuantitas }}</td>
                        <td>Rp {{ number_format($detail->kasir_produk->Harga * $detail->Kuantitas,  0, ',', '.') }}</td>
                        <td>Rp {{ number_format($penjualan->Total_Harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
