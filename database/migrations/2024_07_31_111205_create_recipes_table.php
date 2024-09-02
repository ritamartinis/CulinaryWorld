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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            //FK da tabela Users (já vem p default)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            //FK da tabela Categories
            $table->foreignId('category_id');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->text('ingredients');
            $table->text('instructions');
            $table->integer('prep_time');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
