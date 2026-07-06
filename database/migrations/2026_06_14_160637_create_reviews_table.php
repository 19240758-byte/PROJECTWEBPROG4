<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel reviews beserta relasi foreign key-nya
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel bookings (tiap ulasan harus merujuk ke 1 transaksi trip)
            // onDelete('cascade') artinya jika data booking dihapus, ulasannya ikut terhapus otomatis
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');

            // Relasi ke tabel users (siapa wisatawan yang menulis ulasan ini)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Relasi ke tabel guides (siapa guide/pemandu yang menerima ulasan ini)
            $table->foreignId('guide_id')->constrained('guides')->onDelete('cascade');

            // Kolom rating untuk menyimpan angka bintang (skala 1 sampai 5)
            $table->integer('rating');

            // Kolom komentar dari wisatawan (nullable karena teks komentar sifatnya opsional)
            $table->text('comment')->nullable();

            // Kolom otomatis created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Menghapus tabel jika melakukan rollback migration
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
