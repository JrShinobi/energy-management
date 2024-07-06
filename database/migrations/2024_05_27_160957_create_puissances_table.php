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
        Schema::create('puissances', function (Blueprint $table) {
            $table->id();
            $table->decimal('puissance_atelie');
            $table->decimal('puissance_admin');
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
        Schema::dropIfExists('puissances');
    }
};
