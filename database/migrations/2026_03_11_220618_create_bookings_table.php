<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();

            $table->string('trip_type');
            $table->string('from_location');
            $table->string('to_location');
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->integer('days');
            $table->string('seater');

            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('booking_status')->default('pending_payment');
            $table->string('payment_status')->default('initiated');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
