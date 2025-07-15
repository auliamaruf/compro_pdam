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
            // Remove latitude and longitude columns
            $table->dropColumn(['latitude', 'longitude']);
            
            // Add google_maps_url column
            $table->string('google_maps_url')->nullable()->after('email');
            
            // Remove office_hours JSON column and add simplified office hours
            $table->dropColumn('office_hours');
            $table->string('office_hours_weekday')->nullable()->after('head_of_branch_id');
            $table->string('office_hours_friday')->nullable()->after('office_hours_weekday');
            $table->string('office_hours_weekend')->nullable()->after('office_hours_friday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            // Restore latitude and longitude columns
            $table->decimal('latitude', 10, 8)->nullable()->after('email');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            
            // Remove google_maps_url column
            $table->dropColumn('google_maps_url');
            
            // Restore office_hours JSON column and remove simplified columns
            $table->json('office_hours')->nullable()->after('head_of_branch_id');
            $table->dropColumn(['office_hours_weekday', 'office_hours_friday', 'office_hours_weekend']);
        });
    }
};
