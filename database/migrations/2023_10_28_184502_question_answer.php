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
        Schema::create('question_answer', function (Blueprint $table) {
            $table->unsignedBigInteger('id_question');
            $table->foreign('id_question')->references('id')->on('questions');
            $table->unsignedBigInteger('id_answer');
            $table->foreign('id_answer')->references('id')->on('answers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
