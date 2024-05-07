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
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 40);
            $table->string('foto_perusahaan', 100)->nullable();
            $table->string('telepon', 12)->nullable();
            $table->string('nib', 16)->nullable();
            $table->text('web')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('kodepos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
