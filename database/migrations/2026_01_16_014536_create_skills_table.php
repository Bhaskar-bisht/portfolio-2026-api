<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
            $table->integer('proficiency_percentage')->default(0);
            $table->integer('years_of_experience')->default(0);
            $table->boolean('is_primary_skill')->default(false);
            $table->date('last_used_at')->nullable();
            $table->string('certification_url')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
            
            $table->unique(['user_id', 'technology_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};