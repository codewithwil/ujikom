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
        Schema::create('pinjaman_debet', function (Blueprint $table) {
            $table->string('kode_pinjaman_debet')->primary();
            $table->string('anggota_kode', 10);
            $table->foreign('anggota_kode')->references('kode_anggota')->on('anggota');
            $table->date('tanggal');
            $table->string('periode', 50);
            $table->enum('jenis_pembayaran',['tunai','nontunai'])->default('tunai');
            $table->enum('divisi',['simpan','pinjam'])->default('simpan');
            $table->enum('transaksi',['debet','kredit'])->default('debet');
            $table->integer('nominal');
            $table->enum('keterangan',['debet','kredit'])->default('debet');
            $table->enum('status_buku',['aktif','nonaktif'])->default('aktif');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman_debet');
    }
};
