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
        Schema::create('posologies', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->datetime('medical_order_date');
            $table->integer('frecuency');
            $table->integer('day_quantity');
            $table->timestamps();

            //falta definir type_id como fk y de tabla viene
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posologies');
    }
};
