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
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('director_name')->nullable()->after('company_tagline');
            $table->string('director_position')->nullable()->after('director_name');
            $table->text('director_message')->nullable()->after('director_position');
            $table->string('message_title')->nullable()->default('Sambutan Direktur')->after('director_message');
            $table->boolean('show_director_message')->default(true)->after('message_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'director_name',
                'director_position', 
                'director_message',
                'message_title',
                'show_director_message'
            ]);
        });
    }
};
