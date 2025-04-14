@extends('tampilan')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kategori</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalKategori }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-bullet-list-67 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pelanggan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalPelanggan }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Produk</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalProduk }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-box-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Penjualan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12"> <!-- Ubah dari col-md-6 ke col-md-12 agar lebar penuh -->
        <canvas id="dashboardChart" style="width:100%; height:400px;"></canvas>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      const data = {
    labels: ['Kategori', 'Pelanggan', 'Produk', 'Penjualan'],
    datasets: [{
        label: 'Statistik Data',
        data: [1, 1, 2, 450], // Ganti dengan data yang dinamis
        backgroundColor: 'rgba(255, 105, 180, 0.7)', // Warna pink (hot pink)
        borderColor: 'rgba(255, 20, 147, 1)', // Border pink lebih gelap
        borderWidth: 1
    }]
};
        var ctx = document.getElementById('dashboardChart').getContext('2d');
        var dashboardChart = new Chart(ctx, {
            type: 'bar', // Bisa diganti dengan 'line', 'pie', atau 'doughnut'
            data: {
                labels: ['Kategori', 'Pelanggan', 'Produk', 'Penjualan'],
                datasets: [{
                    label: 'Statistik Data',
                    data: [{{ $totalKategori }}, {{ $totalPelanggan }}, {{ $totalProduk }}, {{ $totalPenjualan }}],
                    backgroundColor: ['#f39c12', '#00a65a', '#3c8dbc', '#d81b60'],
                    borderColor: ['#e67e22', '#27ae60', '#2980b9', '#c0392b'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endsection
