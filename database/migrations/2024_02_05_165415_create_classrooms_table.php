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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('professor_id')->nullable();
            $table->foreign('professor_id')->references('id')->on('professors')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('week_day', ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه'])->nullable();

            $table->unsignedBigInteger('time_period_id')->nullable();
            $table->foreign('time_period_id')->references('id')->on('time_periods')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('status', ['ثابت', 'چرخشی'])->nullable();

            $table->unsignedBigInteger('eg_id')->nullable();
            $table->foreign('eg_id')->references('id')->on('educational_groups')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('entry_id')->nullable();
            $table->foreign('entry_id')->references('id')->on('entries')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
