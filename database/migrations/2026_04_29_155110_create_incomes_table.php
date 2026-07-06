<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel incomes.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $blueprint) {
            $blueprint->id();
            // Menghubungkan ke tabel users (siapa guide-nya)
            $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
            $blueprint->string('nama_pelanggan');
            $blueprint->date('tanggal'); // Pastikan format saat input adalah Y-m-d
            $blueprint->integer('durasi'); // dalam satuan jam
            $blueprint->decimal('biaya', 15, 2); // Menggunakan decimal untuk presisi mata uang
            $blueprint->string('status')->default('disetujui'); // Tambahan: agar bisa filter data yang valid saja
            $blueprint->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
