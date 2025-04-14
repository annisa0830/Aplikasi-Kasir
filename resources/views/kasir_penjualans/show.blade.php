
@extends('tampilan')
@section('content')
<div class="container">
    <h2>Detail Penjualan</h2>
    <a href="{{ route('kasir_penjualans.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('kasir_penjualan.show', ['id' => $kasir_penjualan->PenjualanID, 'pdf' => 1]) }}" class="btn btn-primary ml-2">
    CETAK STRUK
</a>

    <table class="table table-bordered mt-3">
        <tr>
            <th>ID Penjualan</th>
            <td>{{ $kasir_penjualan->PenjualanID }}</td>
        </tr>
        <tr>
            <th>Pelanggan</th>
            <td>{{ $kasir_penjualan->kasir_pelanggan->Nama_Pelanggan ?? 'Umum' }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $kasir_penjualan->Tanggal_Penjualan }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp {{ number_format($kasir_penjualan->Total_Harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Uang Bayar</th>
            <td>Rp {{ number_format($kasir_penjualan->Uang_Bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Uang Kembali</th>
            <td>Rp {{ number_format($kasir_penjualan->Uang_Kembali, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h3>Detail Produk</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kasir_penjualan->detail_penjualans as $detail_penjualan)
                                    <tr>
                                        <td>{{ $detail_penjualan->kasir_produk->Nama_Produk ?? 'Produk Tidak Ditemukan' }}</td>
                                        <td>Rp {{ number_format($detail_penjualan->kasir_produk->Harga ?? 0, 0, ',', '.') }}</td>
                                        <td>{{ $detail_penjualan->Kuantitas }}</td>
                                    </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

