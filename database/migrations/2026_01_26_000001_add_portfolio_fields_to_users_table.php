<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('email');
            $table->string('tagline')->nullable()->after('bio');
            $table->string('current_position')->nullable();
            $table->integer('years_of_month')->default(0);
            $table->integer('years_of_experience')->default(0);
            $table->string('location')->nullable();
            $table->string('timezone')->default('UTC');
            $table->enum('availability_status', ['available', 'busy', 'not_looking'])->default('available');
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('behance_url')->nullable();
            $table->string('dribbble_url')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio', 'tagline', 'current_position', 'years_of_experience',
                'location', 'timezone', 'availability_status', 'github_url',
                'linkedin_url', 'twitter_url', 'behance_url', 'dribbble_url'
            ]);
            $table->dropSoftDeletes();
        });
    }
};