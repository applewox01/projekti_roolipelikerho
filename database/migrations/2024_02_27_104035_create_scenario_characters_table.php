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
        Schema::create('scenario_characters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('scenario_id');
            $table->timestamps();
        });
        if (Schema::hasColumn('scenario_characters', 'scenario_id')) {
            Schema::table('scenario_characters', function (Blueprint $table) {
                $table->foreign('scenario_id')->references('id')->on('scenarios')->onDelete('cascade');
            });
        }
        if (Schema::hasColumn('scenario_characters', 'character_id')) {
            Schema::table('scenario_characters', function (Blueprint $table) {
                $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenario_characters');
    }
};
