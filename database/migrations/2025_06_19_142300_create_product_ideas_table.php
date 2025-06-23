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
        Schema::create('product_ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('difficulty_level');
            $table->json('required_tools');
            $table->text('short_description');
            $table->string('estimated_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_ideas');
    }
};
