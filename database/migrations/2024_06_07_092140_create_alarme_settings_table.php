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
        Schema::create('alarme_settings', function (Blueprint $table) {
        $table->id();
        $table->float('courant');
        $table->float('tension');
        $table->float('puissance');
        $table->float('energie');
        $table->float('frequence');
        $table->float('facteur_puissance');
        $table->timestamp('last_checked_at')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarme_settings');
    }
};
