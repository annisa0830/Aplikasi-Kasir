<form action="{{ url('/penjualan') }}" method="POST">
    @csrf
    <label for="ProdukID">Pilih Produk:</label>
    <select name="ProdukID" required>
        @foreach ($kasir_produk as $p)
            <option value="{{ $p->ProdukID }}">{{ $p->Nama_Produk }} (Stok: {{ $p->Stok }})</option>
        @endforeach
    </select>

    <label for="Jumlah_Produk">Jumlah:</label>
    <input type="number" name="Jumlah_Produk" min="1" required>

    <button type="submit">Beli</button>
</form>
