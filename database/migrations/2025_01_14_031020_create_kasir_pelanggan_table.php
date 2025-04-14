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
        Schema::create('kasir_pelanggans', function (Blueprint $table) {
            $table->bigIncrements('PelangganID');
            $table->string('Nama_Pelanggan', 32);
            $table->string('Alamat');
            $table->string('Nomor_Telepon', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasir_pelanggans');
    }
};
