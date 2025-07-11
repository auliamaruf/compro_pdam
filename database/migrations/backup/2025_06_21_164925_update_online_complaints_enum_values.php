<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any existing data with old enum values to new ones
        DB::table('online_complaints')->where('status', 'received')->update(['status' => 'pending']);

        // Drop and recreate the table with updated enum values
        Schema::table('online_complaints', function (Blueprint $table) {
            $table->dropColumn(['complaint_type', 'status']);
        });

        Schema::table('online_complaints', function (Blueprint $table) {
            $table->enum('complaint_type', [
                'billing',
                'water_quality',
                'water_pressure',
                'service_connection',
                'pipe_damage',
                'meter_reading',
                'other'
            ])->after('address');

            $table->enum('status', [
                'pending',
                'in_progress',
                'resolved',
                'closed',
                'cancelled'
            ])->default('pending')->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to old enum values
        Schema::table('online_complaints', function (Blueprint $table) {
            $table->dropColumn(['complaint_type', 'status']);
        });

        Schema::table('online_complaints', function (Blueprint $table) {
            $table->enum('complaint_type', [
                'water_quality',
                'no_water_supply',
                'low_water_pressure',
                'pipe_leak',
                'meter_issue',
                'billing_dispute',
                'service_disruption',
                'other'
            ])->after('address');

            $table->enum('status', [
                'received',
                'in_progress',
                'resolved',
                'closed',
                'cancelled'
            ])->default('received')->after('priority');
        });
    }
};
