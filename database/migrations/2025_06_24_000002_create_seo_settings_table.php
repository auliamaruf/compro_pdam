<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_type'); // 'home', 'news', 'page', 'service', etc.
            $table->string('page_identifier')->nullable(); // specific page slug or ID
            $table->string('meta_title');
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index,follow');
            $table->json('schema_markup')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['page_type', 'page_identifier']);
            $table->index(['page_type', 'is_active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('seo_settings');
    }
};
