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
        Schema::create('classroom_location_term', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('term_id')->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classroom_location_term', function (Blueprint $table) {
            //
        });
    }
};
