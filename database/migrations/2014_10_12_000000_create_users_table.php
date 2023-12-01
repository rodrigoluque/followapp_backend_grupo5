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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('name');
            $table->string('surname');
            $table->integer('dni')->unique();
            $table->date('born_date');
            $table->string('mail')->unique();
            $table->string('cellphone',15);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_date');
            $table->string('logon_date');
            $table->string('assurance');
            $table->integer('assurance_number')->unique();
            $table->string('rol');
            $table->rememberToken();
            $table->timestamps();


            //$table->foreignId('assurance_id')->constrained('assurances')->onUpdate('cascade')->onDelete('restrict')->nullable();
            //$table->foreignId('rol_id')->constrained('roles')->onUpdate('cascade')->onDelete('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
