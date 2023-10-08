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
            $table->id();
            $table->unsignedBigInteger('id_poll');
            $table->foreign('id_poll')->references('id')->on('polls');
            $table->unsignedBigInteger('id_type_avaliation');
            $table->foreign('id_type_avaliation')->references('id')->on('type_avaliations');
            $table->char('statement', 20);
            $table->smallInteger('order_question');
            $table->boolean('has_comment');
            $table->boolean('status_question');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
