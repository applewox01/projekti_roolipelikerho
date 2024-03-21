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
        Schema::create('monster', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scenario_id')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
        if (Schema::hasColumn('monster', 'scenario_id')) {
            Schema::table('monster', function (Blueprint $table) {
                $table->foreign('scenario_id')->references('id')->on('scenarios')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monster');
    }
};
