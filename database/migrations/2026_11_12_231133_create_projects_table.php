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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('mini');
            $table->string('category_label')->default('مینی پروژه');
            $table->string('icon')->default('🚀');
            $table->string('mock_url')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('full_desc')->nullable();
            $table->json('features')->nullable();
            $table->json('tags')->nullable();
            $table->string('hosted_url');
            $table->string('github_url')->nullable();
            $table->string('gradient')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
