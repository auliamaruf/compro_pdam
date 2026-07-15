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
        Schema::table('customer_infos', function (Blueprint $table) {
            $table->string('category')->default('umum');
            $table->dateTime('display_until')->nullable();
            $table->dateTime('repair_start')->nullable();
            $table->dateTime('repair_end')->nullable();
            $table->date('promo_start')->nullable();
            $table->date('promo_end')->nullable();
            $table->text('affected_areas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_infos', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'display_until',
                'repair_start',
                'repair_end',
                'promo_start',
                'promo_end',
                'affected_areas',
            ]);
        });
    }
};
