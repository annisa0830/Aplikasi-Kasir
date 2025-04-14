@extends('tampilan')
@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Penjualan</h2>
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('kasir_penjualans.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="PelangganID" class="form-label">Pilih Pelanggan</label>
            <select name="PelangganID" id="PelangganID" class="form-control select2" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($kasir_pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->PelangganID }}">{{ $pelanggan->Nama_Pelanggan }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="Tanggal_Penjualan" class="form-label">Tanggal Penjualan</label>
            <input type="date" name="Tanggal_Penjualan" id="Tanggal_Penjualan" class="form-control" required>
        </div>
        
        <h4>Produk</h4>
        <div id="produk-container">
            <div class="produk-item mb-3">
                <select name="products[0][ProdukID]" class="form-control produk-select select2" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($kasir_produks as $produk)
                        <option value="{{ $produk->ProdukID }}" data-harga="{{ $produk->Harga }}">
                            {{ $produk->Nama_Produk }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="products[0][Kuantitas]" class="form-control mt-2 kuantitas" placeholder="Kuantitas" required>
                <input type="text" class="form-control mt-2 harga-produk" placeholder="Harga" readonly>

                <button type="button" class="btn btn-danger mt-2 remove-produk" style="display: none;">Hapus</button>
            </div>
        </div>
        
        <button type="button" id="add-produk" class="btn btn-primary mt-2">Tambah Produk</button>
        
        <div class="mb-3 mt-4">
            <label for="Total_Harga" class="form-label">Total Harga</label>
            <input type="text" name="Total_Harga" id="Total_Harga" class="form-control" readonly>
        </div>
        
        <div class="mb-3">
            <label for="Uang_Bayar" class="form-label">Uang Bayar</label>
            <input type="number" name="Uang_Bayar" id="Uang_Bayar" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="Uang_Kembali" class="form-label">Uang Kembali</label>
            <input type="text" name="Uang_Kembali" id="Uang_Kembali" class="form-control" readonly>
        </div>
        
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<!-- Load Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    $('.select2').select2({ placeholder: "Pilih", allowClear: true });

    let produkIndex = 1;

    document.getElementById("add-produk").addEventListener("click", function () {
        const container = document.getElementById("produk-container");
        const newProduk = document.createElement("div");
        newProduk.classList.add("produk-item", "mb-3");

        newProduk.innerHTML = `
            <select name="products[${produkIndex}][ProdukID]" class="form-control produk-select select2" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($kasir_produks as $produk)
                    <option value="{{ $produk->ProdukID }}" data-harga="{{ $produk->Harga }}">
                        {{ $produk->Nama_Produk }}
                    </option>
                @endforeach
            </select>
            <input type="number" name="products[${produkIndex}][Kuantitas]" class="form-control mt-2 kuantitas" placeholder="Kuantitas" required>
            <input type="text" name="products[${produkIndex}][Harga]" class="form-control mt-2 harga-produk" placeholder="Harga" readonly>
            <button type="button" class="btn btn-danger mt-2 remove-produk">Hapus</button>
        `;

        container.appendChild(newProduk);
        $('.select2').select2(); // Re-inisialisasi Select2 setelah elemen baru ditambahkan
        produkIndex++;
    });

    document.getElementById("produk-container").addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-produk")) {
            e.target.parentElement.remove();
            hitungTotal();
        }
    });

    document.getElementById("produk-container").addEventListener("change", function (e) {
        if (e.target.classList.contains("produk-select")) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const hargaInput = e.target.closest(".produk-item").querySelector(".harga-produk");
            
            if (selectedOption.value) {
                hargaInput.value = parseInt(selectedOption.getAttribute("data-harga") || 0);
            } else {
                hargaInput.value = "";
            }

            hitungTotal();
        }
    });

    document.getElementById("produk-container").addEventListener("input", function (e) {
        if (e.target.classList.contains("kuantitas")) {
            hitungTotal();
        }
    });

    document.getElementById("Uang_Bayar").addEventListener("input", function () {
        hitungKembalian();
    });

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll(".produk-item").forEach(item => {
            const select = item.querySelector(".produk-select");
            const kuantitas = item.querySelector(".kuantitas");
            const hargaInput = item.querySelector(".harga-produk");

            if (select.value && kuantitas.value) {
                const harga = parseInt(select.options[select.selectedIndex].getAttribute("data-harga")) || 0;
                const subtotal = harga * parseInt(kuantitas.value);
                total += subtotal;
                hargaInput.value = harga;
            }
        });

        document.getElementById("Total_Harga").value = new Intl.NumberFormat('id-ID').format(total);
        hitungKembalian();
    }

    function hitungKembalian() {
    // Ambil nilai dari input, hilangkan karakter selain angka dan titik, lalu ubah ke float
    const total = parseFloat(document.getElementById("Total_Harga").value.replace(/[^\d,]/g, '').replace(',', '.')) || 0;
    const bayar = parseFloat(document.getElementById("Uang_Bayar").value.replace(/[^\d,]/g, '').replace(',', '.')) || 0;

    // Hitung kembalian
    let kembali = bayar - total;

    // Jika kembalian negatif, set ke 0 agar tidak menampilkan angka minus
    if (kembali < 0) {
        kembali = 0;
    }

    // Format hasil dengan titik ribuan sesuai format IDR
    document.getElementById("Uang_Kembali").value = `Rp ${kembali.toLocaleString('id-ID')}`;
}
});

</script>
@endsection
