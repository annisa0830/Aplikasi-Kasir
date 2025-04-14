<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kasir_produks', function (Blueprint $table) {
            $table->bigIncrements('ProdukID'); 
            $table->unsignedBigInteger('KategoriID');
            $table->integer('Stok')->default(0)->change();
            $table->string('Nama_Produk', 32); 
            $table->decimal('Harga', 10, 2); 
            $table->timestamps(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasir_produks');
    }
};
