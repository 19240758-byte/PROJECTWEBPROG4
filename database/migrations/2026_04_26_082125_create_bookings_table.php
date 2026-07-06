<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('guide_id')->nullable()->constrained('guides')->onDelete('set null');
        $table->foreignId('equipment_id')->nullable()->constrained('equipments')->onDelete('set null'); // FIXED: 'equipments' bukan 'equipment'
        $table->date('booking_date');
        $table->time('start_time')->nullable();
        $table->time('end_time')->nullable();
        $table->integer('duration_hours')->nullable();
        $table->integer('equipment_quantity')->default(1);
        $table->decimal('guide_cost', 10, 2)->default(0);
        $table->decimal('equipment_cost', 10, 2)->default(0);
        $table->decimal('total_cost', 10, 2);
        $table->text('notes')->nullable();
        $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled'])->default('pending');
        $table->timestamps();

        // Tambah index untuk performa
        $table->index(['booking_date', 'status']);
        $table->index('guide_id');
        $table->index('equipment_id');
    });
}
};
