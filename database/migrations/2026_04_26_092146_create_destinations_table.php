<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('photo');
            $table->decimal('distance_from_purwokerto', 8, 2)->nullable(); // km
            $table->decimal('difficulty_level', 3, 1)->default(3); // 1-5
            $table->enum('category', ['gunung', 'air terjun', 'danau', 'pantai', 'hutan']);
            $table->boolean('guide_recommended')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};
