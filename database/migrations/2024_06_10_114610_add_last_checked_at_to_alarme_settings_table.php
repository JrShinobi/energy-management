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
        Schema::table('alarme_settings', function (Blueprint $table) {
            $table->timestamp('last_checked_at')->nullable()->after('existing_column'); // Add 'after' to position the new column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alarme_settings', function (Blueprint $table) {
            $table->dropColumn('last_checked_at');
        });
    }
};
