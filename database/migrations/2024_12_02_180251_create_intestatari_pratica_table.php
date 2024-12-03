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
            $table->unsignedBigInteger('id_intestatario'); // id_intestatario (bigint, unsigned)
            $table->unsignedBigInteger('id_pratica'); // id_pratica (bigint, unsigned)
            $table->timestamps();
            $table->foreign('id_intestatario')->references('id')->on('intestatari')->onDelete('cascade');
            $table->foreign('id_pratica')->references('id')->on('pratiche')->onDelete('cascade');

            // Unique constraint for the combination
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
