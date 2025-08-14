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
        Schema::table('news', function (Blueprint $table) {
            $table->json('documents')->nullable()->after('meta')->comment('Document attachments (files and URLs)');
            $table->boolean('has_documents')->default(false)->after('documents')->comment('Flag to indicate if news has attached documents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['documents', 'has_documents']);
        });
    }
};
