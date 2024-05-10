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
        Schema::create('simpanan_kredit', function (Blueprint $table) {
            $table->string('kode_simpanan_kredit', 10)->primary();
            $table->string('anggota_kode', 10);
            $table->foreign('anggota_kode')->references('kode_anggota')->on('anggota');
            $table->date('tanggal');
            $table->enum('jenis_pembayaran',['tunai','nontunai'])->default('tunai');
            $table->enum('divisi',['simpan','pinjam'])->default('simpan');
            $table->enum('keterangan',['debet','kredit'])->default('debet');
            $table->integer('nominal');
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
        Schema::dropIfExists('simpanan_kredit');
    }
};
