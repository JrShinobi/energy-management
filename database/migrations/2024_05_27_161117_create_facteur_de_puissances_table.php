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
        Schema::create('facteur_de_puissances', function (Blueprint $table) {
            $table->id();
            $table->decimal('facteur_atelie');
            $table->decimal('facteur_admin');
            $table->decimal('usine');
            $table->decimal('magasin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facteur_de_puissances');
    }
};
