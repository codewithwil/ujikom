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
        Schema::create('simpanan_debet', function (Blueprint $table) {
            $table->string('kode_simpanan_debet');
            $table->string('anggota_kode', 10);
            $table->foreign('anggota_kode')->references('kode_anggota')->on('anggota');
            $table->date('tanggal');
            $table->enum('jenis_pembayaran',['tunai','nontunai'])->default('tunai');
            $table->enum('transaksi',['debet','kredit'])->default('debet');
            $table->enum('divisi',['simpan','pinjam'])->default('simpan');
            $table->enum('keterangan',['debet','kredit'])->default('debet');
            $table->integer('pokok');
            $table->integer('wajib');
            $table->integer('sukarela');
            $table->enum('status_buku',['aktif','nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpanan_debet');
    }
};
