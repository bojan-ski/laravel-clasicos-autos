<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_makers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

         // Insert the car manufacturers
         $now = Carbon::now();

         $manufacturers = [
            ['name' => 'Alfa Romeo', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Aston Martin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Austin-Healey', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Bentley', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Buick', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cadillac', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chevrolet', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chrysler', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Citroën', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Datsun', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DeSoto', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dodge', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ferrari', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fiat', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ford', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hudson', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jaguar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lamborghini', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lancia', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lincoln', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Maserati', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mercedes-Benz', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mercury', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MG', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Nash', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Oldsmobile', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Packard', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Peugeot', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Plymouth', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pontiac', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Porsche', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Renault', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rolls-Royce', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Studebaker', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Triumph', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Volkswagen', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Volvo', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('car_makers')->insert($manufacturers);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_makers');
    }
};
