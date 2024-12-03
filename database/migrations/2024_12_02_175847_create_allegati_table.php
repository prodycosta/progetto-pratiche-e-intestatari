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
        Schema::create('allegati', function (Blueprint $table) {
            $table->id();
            $table->string('NomeFile'); // NomeFile (varchar 255)
            $table->binary('File'); // File (longblob)
            $table->unsignedBigInteger('id_pratica'); // id_pratica (bigint, unsigned)
            $table->timestamps();
            $table->foreign('id_pratica')->references('id')->on('pratiche')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allegati');
    }
};
