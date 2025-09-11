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
        Schema::table('company_histories', function (Blueprint $table) {
            $table->string('year', 20)->change(); // Extend year column to allow ranges like "1980-1990"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_histories', function (Blueprint $table) {
            $table->string('year', 4)->change(); // Revert back to 4 characters
        });
    }
};
