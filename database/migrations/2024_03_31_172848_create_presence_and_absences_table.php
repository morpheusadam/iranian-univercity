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
        Schema::create('presence_and_absences', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('status', ['created', 'not_created', 'empty']);

            $table->date('date');

            $table->unsignedBigInteger('term_id')->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_and_absences');
    }
};
