<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('car_type')->nullable();
            $table->integer('seats');
            $table->boolean('has_ac')->default(true);
            $table->decimal('rating', 3, 1)->default(4.0);
            $table->integer('ratings_count')->default(0);
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('other_charges', 10, 2)->default(0);
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
