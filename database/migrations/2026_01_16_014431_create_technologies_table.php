<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('category', ['language', 'framework', 'tool', 'database', 'devops', 'other'])->default('other');
            $table->enum('proficiency_level', ['beginner', 'intermediate', 'expert'])->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->string('color_code')->nullable();
            $table->string('background_color')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('documentation_url')->nullable();
            $table->string('official_url')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technologies');
    }
};