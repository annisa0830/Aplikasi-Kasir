<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            max-width: 360px;
            margin: auto;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .struk {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .info, .items, .summary {
            margin-bottom: 10px;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items th, .items td {
            text-align: left;
            padding: 5px 0;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
        }
        .btn-kembali {
            display: block;
            width: 100px;
            margin: 15px auto;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-kembali:hover {
            background-color: #0056b3;
        }
        @media print {
            .btn-kembali {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="struk">
        <div class="header">VIVRE MART</div>
        <div class="info">
            <p>ID Penjualan: {{ $kasir_penjualan->PenjualanID }}</p>
            <p>Pelanggan: {{ $kasir_penjualan->kasir_pelanggan->Nama_Pelanggan ?? 'Umum' }}</p>
            <p>Tanggal: {{ $kasir_penjualan->Tanggal_Penjualan }}</p>
        </div>
        
        <hr>
        
        <div class="items">
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                @foreach($kasir_penjualan->detail_penjualans as $detail)
                <tr>
                    <td>{{ $detail->kasir_produk->Nama_Produk ?? 'Produk Tidak Ditemukan' }}</td>
                    <td>{{ $detail->Kuantitas }}</td>
                    <td class="total">Rp {{ number_format(($detail->kasir_produk->Harga ?? 0) * $detail->Kuantitas, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
        <hr>
        
        <div class="summary">
            <p class="total">Total: Rp {{ number_format($kasir_penjualan->Total_Harga, 0, ',', '.') }}</p>
            <p class="total">Bayar: Rp {{ number_format($kasir_penjualan->Uang_Bayar, 0, ',', '.') }}</p>
            <p class="total">Kembali: Rp {{ number_format($kasir_penjualan->Uang_Kembali, 0, ',', '.') }}</p>
        </div>
        
        <hr>
        
        <div class="footer">
            <p>*** Terima kasih atas transaksi Anda ***</p>
            <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
        </div>
    </div>
    
    <a href="{{ url()->previous() }}" class="btn-kembali">Kembali</a>

</body>
</html>
