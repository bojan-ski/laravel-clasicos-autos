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
        Schema::create('car_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->integer('mileage');
            $table->string('exterior_color')->nullable();
            $table->string('interior_color')->nullable();
            $table->enum('transmission', ['Manual', 'Automatic']);
            $table->enum('fuel_type', ['Gasoline', 'Diesel'])->default('Gasoline');
            $table->string('engine_size')->nullable();
            $table->string('engine_type')->nullable();
            $table->enum('odometer', ['Original', 'Rebuilt', 'Unknown'])->default('Original');
            $table->enum('exterior_condition', ['Showroom Condition', 'Good', 'Fair', 'Needs Restoration'])->default('Good');
            $table->enum('interior_condition', ['Showroom Condition', 'Good', 'Fair', 'Needs Restoration'])->default('Good');
            $table->string('seat_material')->nullable();
            $table->text('engine_history')->nullable();
            $table->enum('engine_condition', ['Running', 'Needs Tuning', 'Not Running', 'Rebuilt Engine', 'Original Factory Engine'])->default('Running');
            $table->decimal('price', 10, 2);
            $table->string('location_city')->nullable();
            $table->string('location_state')->nullable();
            $table->json('images')->nullable();
            $table->string('body_type')->nullable();
            $table->enum('restoration_history', ['Fully Restored', 'Partially Restored', 'Barn Find', 'Unrestored Original'])->default('Unrestored Original');
            $table->integer('original_parts_percentage')->nullable();
            $table->enum('license_plate_type', ['Original Plate', 'Modern Plate', 'No Plate'])->default('Modern Plate');
            $table->enum('documentation_status', ['Original Papers', 'Missing Papers', 'Custom Registration'])->default('Original Papers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_listings');
    }
};
