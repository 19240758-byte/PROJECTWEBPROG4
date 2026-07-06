<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom status.
     */
    public function up(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            // Kita tambahkan kolom status setelah kolom biaya
            $table->string('status')->default('disetujui')->after('biaya');
        });
    }

    /**
     * Batalkan migrasi (Hapus kolom status).
     */
    public function down(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
