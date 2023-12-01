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
        Schema::create('alarms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('posology_id')->constrained('posologies')->onUpdate('cascade')->onDelete('restrict')->nullable();
            //$table->foreignId('alarm_type_id')->constrained('alarms_type')->onUpdate('cascade')->onDelete('restrict')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarms');
    }
};
