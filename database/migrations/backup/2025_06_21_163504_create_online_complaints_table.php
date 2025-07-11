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
        Schema::create('online_complaints', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Auto-generated ticket number
            $table->string('customer_name');
            $table->string('customer_id_number')->nullable(); // Customer ID/Account number
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->enum('complaint_type', [
                'water_quality',
                'no_water_supply',
                'low_water_pressure',
                'pipe_leak',
                'meter_issue',
                'billing_dispute',
                'service_disruption',
                'other'
            ]);
            $table->string('subject');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', [
                'received',
                'in_progress',
                'resolved',
                'closed',
                'cancelled'
            ])->default('received');
            $table->json('attachments')->nullable(); // Store file paths
            $table->text('admin_response')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable(); // Admin user ID
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index(['complaint_type', 'created_at']);
            $table->index(['priority', 'created_at']);
            $table->index('ticket_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_complaints');
    }
};
