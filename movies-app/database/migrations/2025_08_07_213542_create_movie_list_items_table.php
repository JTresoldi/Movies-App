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
        Schema::create('movie_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_list_id')
                ->constrained('movie_lists')
                ->onDelete('cascade');
            $table->unsignedBigInteger('movie_id'); 
            $table->unique(['movie_list_id', 'movie_id']); //Evitamos filmes duplicados na lista
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_list_items');
    }
};
