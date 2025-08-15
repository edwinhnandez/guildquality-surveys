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
        Schema::create('survey_question', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('question_id');

            // Composite primary key + reverse index
            $table->primary(['survey_id', 'question_id']);
            $table->index(['question_id', 'survey_id']);

            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_question');
    }
};
