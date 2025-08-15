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
        Schema::create('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('name', 150);
            $table->text('question_text');
            $table->string('question_type', 40); // e.g. 'rating', 'comment-only', 'multiple-choice'
            $table->timestamps();

            $table->index(['question_type', 'name']); // Index for faster lookups
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('questions');
        Schema::enableForeignKeyConstraints();
    }
};
