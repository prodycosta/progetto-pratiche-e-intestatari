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
        Schema::create('intestatari_pratica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_intestatario'); // riferimento alla tabella "intestatari"
            $table->unsignedBigInteger('id_pratica'); // riferimento alla tabella "pratiche"
            $table->timestamps();

            // Definizione delle chiavi esterne con eliminazione a cascata
            $table->foreign('id_intestatario')
                  ->references('id')
                  ->on('intestatari')
                  ->onDelete('cascade');
            $table->foreign('id_pratica')
                  ->references('id')
                  ->on('pratiche')
                  ->onDelete('cascade');

            // Vincolo unico per la combinazione di id_intestatario e id_pratica
            $table->unique(['id_intestatario', 'id_pratica']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intestatari_pratica');
    }
};

