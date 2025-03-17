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
        Schema::create('utenti', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // nome (varchar 255)
            $table->string('cognome'); // cognome (varchar 255)
            $table->string('username')->unique(); // username (varchar 255, unique)
            $table->string('password'); // password (varchar 255)
            $table->string('email')->unique(); // email (varchar 255, unique)
            $table->string('data_creazione'); // data_creazione (varchar 255)
            $table->boolean('attivo'); // attivo (tinyint 1)
            $table->integer('ruolo'); // ruolo (int 11)
            $table->string('remember_token', 100)->nullable(); // remember_token (varchar 100, nullable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utenti');
    }
};
