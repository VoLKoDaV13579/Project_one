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
        Schema::create('rcl_repairs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recycler_id');
            $table->foreign('recycler_id')->references('id')->on('recycler_lists');
            // $table->foreign('recycler_id')->references('id')->on('recycler_lists');
            $table->unsignedBigInteger('theme_id');
            $table->foreign('theme_id')->references('id')->on('recycler_themes');
            // $table->foreign('theme_id')->references('id')->on('recycler_themes');
            $table->unsignedBigInteger('solution_id');
            $table->foreign('solution_id')->references('id')->on('recycler_solutions');
            // $table->foreign(['solution_id', 'recycler_id', 'theme_id'])->references(['id', 'id', 'id'])->on(['recycler_solutions', 'recycler_lists', 'recycler_themes']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rcl_repairs');
    }
};
