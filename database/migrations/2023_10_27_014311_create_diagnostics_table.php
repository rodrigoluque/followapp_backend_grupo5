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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('treatment_date');
            $table->time('treatment_hour');
            $table->string('diagnostic');

            $table->string('observation');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->nullable();
            $table->foreignId('medicament_id')->constrained('medication_types')->onUpdate('cascade')->onDelete('restrict')->nullable();
            //$table->foreignId('treatment_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
