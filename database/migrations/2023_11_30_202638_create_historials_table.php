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
        Schema::create('historials', function (Blueprint $table) {
            $table->id();
            $table->string('afeccion');
            $table->string('medicamento');
            $table->string('forma_farmaceutica');
            $table->string('composicion');
            $table->string('tratamiento');
            $table->date('fecha_inicio');
            $table->time('hora_inicio');
            $table->date('fecha_fin');
            $table->time('hora_fin');
            $table->boolean('cada_24');
            $table->boolean('cada_12');
            $table->boolean('cada_8');
            $table->boolean('cada_6');
            $table->boolean('antes_almuerzo_cena');
            $table->boolean('despues_almuerzo_cena');
            $table->boolean('cuando_sea_necesario');
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historials');
    }
};
