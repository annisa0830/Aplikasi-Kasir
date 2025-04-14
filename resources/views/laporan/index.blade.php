@extends('tampilan')
@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Penjualan</h2>
    
    <form action="{{ route('laporan.cetak') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>
        <div class="col-md-5">
            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Cetak PDF</button>
        </div>
    </div>
</form>

</div>
@endsection
