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
        Schema::create('tensions', function (Blueprint $table) {
            $table->id();
            $table->decimal('tension_atelie');
            $table->decimal('tension_admin');
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
        Schema::dropIfExists('tensions');
    }
};
