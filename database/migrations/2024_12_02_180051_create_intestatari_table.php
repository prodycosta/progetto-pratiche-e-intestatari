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
        Schema::create('intestatari', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // nome (varchar 255)
            $table->string('cognome'); // cognome (varchar 255)
            $table->string('cap'); // cap (varchar 255)
            $table->string('indirizzo'); // indirizzo (varchar 255)
            $table->string('numero_civico'); // numero_civico (varchar 255)
            $table->string('comune'); // comune (varchar 255)
            $table->string('provincia'); // provincia (varchar 255)
            $table->string('numero_documento'); // numero_documento (varchar 255)
            $table->date('scadenza_documento'); // scadenza_documento (date)
            $table->string('codice_fiscale'); // codice_fiscale (varchar 255)
            $table->date('data_nascita'); // data_nascita (date)
            $table->string('numero_telefono'); // numero_telefono (varchar 255)
            $table->unsignedBigInteger('id_utente'); // id_utente (bigint, unsigned)
            $table->timestamps();
            $table->foreign('id_utente')->references('id')->on('utenti')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intestatari');
    }
};
