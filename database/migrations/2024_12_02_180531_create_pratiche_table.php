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
        Schema::create('pratiche', function (Blueprint $table) {
            $table->id();
            $table->string('indirizzo'); // indirizzo (varchar 255)
            $table->string('provincia'); // provincia (varchar 255)
            $table->string('comune'); // comune (varchar 255)
            $table->string('cap'); // cap (varchar 255)
            $table->integer('anni_contratto'); // anni_contratto (int 11)
            $table->unsignedBigInteger('id_utente'); // id_utente (bigint, unsigned)
            $table->unsignedBigInteger('id_stato'); // id_stato (bigint, unsigned)
            $table->longText('id_intestatari'); // id_intestatari (longtext)
            $table->string('numero_civico')->nullable(); // numero_civico (varchar 255, nullable)
            $table->timestamps();

            $table->foreign('id_utente')->references('id')->on('utenti')->onDelete('cascade');
            $table->foreign('id_stato')->references('id')->on('stato_pratiche')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pratiche');
    }
};
