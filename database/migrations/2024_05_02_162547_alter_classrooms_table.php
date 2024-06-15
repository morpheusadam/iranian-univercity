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
        Schema::table('classrooms', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned()->index()->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
        Schema::table('educational_groups', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned()->index()->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
        Schema::table('entries', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned()->index()->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned()->index()->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned()->index()->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
        Schema::table('professors', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned()->index()->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
        Schema::table('time_periods', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned()->index()->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
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
