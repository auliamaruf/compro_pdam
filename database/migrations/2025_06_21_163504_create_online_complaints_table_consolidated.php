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
            
            // Updated enum values (from second migration)
            $table->enum('complaint_type', [
                'billing',
                'water_quality',
                'water_pressure',
                'service_connection',
                'pipe_damage',
                'meter_reading',
                'other'
            ]);
            
            $table->string('subject');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            
            // Updated enum values (from second migration)
            $table->enum('status', [
                'pending',
                'in_progress',
                'resolved',
                'closed',
                'cancelled'
            ])->default('pending');
            
            $table->json('attachments')->nullable(); // Store file paths
            $table->text('admin_response')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable(); // Admin user ID
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index('ticket_number');
            $table->index('status');
            $table->index('complaint_type');
            $table->index('customer_id_number');
            $table->index('email');
            $table->index('assigned_to');
            $table->index('created_at');
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
