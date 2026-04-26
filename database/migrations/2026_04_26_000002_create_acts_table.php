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
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapter_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order_number');
            $table->timestamps();

            // Foreign key
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');

            // Unique constraint for order_number within chapter
            $table->unique(['chapter_id', 'order_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acts');
    }
};
