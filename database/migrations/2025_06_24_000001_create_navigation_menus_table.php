<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->enum('target', ['_self', '_blank'])->default('_self');
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_external')->default(false);
            $table->text('description')->nullable();
            $table->enum('position', ['main', 'footer', 'sidebar'])->default('main');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('navigation_menus')->onDelete('cascade');
            $table->index(['position', 'is_active', 'sort_order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('navigation_menus');
    }
};
