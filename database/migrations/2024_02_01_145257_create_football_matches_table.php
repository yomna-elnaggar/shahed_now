<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('football_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teamF_id')->nullable()->references('id')->on('teams')->onDelete('cascade');
            $table->integer('resultF')->nullable();
            $table->foreignId('teamS_id')->nullable()->references('id')->on('teams')->onDelete('cascade');
            $table->integer('resultS')->nullable();
            $table->string('place')->nullable();
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete('cascade');
            $table->string('live')->nullable();
            $table->enum('status', ['live', 'finished','unstarted'])->default('unstarted');
            $table->dateTime('match_datetime')->nullable()->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_matches');
    }
};
