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
        Schema::create('kasir_penjualans', function (Blueprint $table) {
            $table->bigIncrements('PenjualanID');
            $table->unsignedBigInteger('PelangganID');  
            $table->date('Tanggal_Penjualan'); 
            $table->decimal('Total_Harga', 10, 2); 
            $table->decimal('Uang_Bayar', 10, 2); 
            $table->decimal('Uang_Kembali', 10, 2); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *  'PelangganID',
     */
    public function down(): void
    {
        Schema::dropIfExists('kasir_penjualans');
    }
};
