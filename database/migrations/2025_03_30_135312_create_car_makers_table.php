<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
         $manufacturers = [
            ['name' => 'Alfa Romeo'],
            ['name' => 'Aston Martin'],
            ['name' => 'Austin-Healey'],
            ['name' => 'Bentley'],
            ['name' => 'Buick'],
            ['name' => 'Cadillac'],
            ['name' => 'Chevrolet'],
            ['name' => 'Chrysler'],
            ['name' => 'Citroën'],
            ['name' => 'Datsun'],
            ['name' => 'DeSoto'],
            ['name' => 'Dodge'],
            ['name' => 'Ferrari'],
            ['name' => 'Fiat'],
            ['name' => 'Ford'],
            ['name' => 'Hudson'],
            ['name' => 'Jaguar'],
            ['name' => 'Lamborghini'],
            ['name' => 'Lancia'],
            ['name' => 'Lincoln'],
            ['name' => 'Maserati'],
            ['name' => 'Mercedes-Benz'],
            ['name' => 'Mercury'],
            ['name' => 'MG'],
            ['name' => 'Nash'],
            ['name' => 'Oldsmobile'],
            ['name' => 'Packard'],
            ['name' => 'Peugeot'],
            ['name' => 'Plymouth'],
            ['name' => 'Pontiac'],
            ['name' => 'Porsche'],
            ['name' => 'Renault'],
            ['name' => 'Rolls-Royce'],
            ['name' => 'Studebaker'],
            ['name' => 'Triumph'],
            ['name' => 'Volkswagen'],
            ['name' => 'Volvo'],
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
