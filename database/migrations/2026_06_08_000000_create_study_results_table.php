<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_results', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('course_code', 50);
            $table->integer('earned_ec');
            $table->timestamps();

            $table->unique(['user_id', 'course_code']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_results');
    }
};

