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
        Schema::table('branches', function (Blueprint $table) {
            // Remove office_hours_weekend column
            $table->dropColumn('office_hours_weekend');
            
            // Add office_hours_saturday and office_hours_sunday columns
            $table->string('office_hours_saturday')->nullable()->after('office_hours_friday');
            $table->string('office_hours_sunday')->nullable()->after('office_hours_saturday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            // Remove the new columns
            $table->dropColumn(['office_hours_saturday', 'office_hours_sunday']);
            
            // Restore office_hours_weekend column
            $table->string('office_hours_weekend')->nullable()->after('office_hours_friday');
        });
    }
};
