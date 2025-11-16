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
        Schema::create('material_ins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingredient_id');
            $table->unsignedBigInteger('total_price');
            $table->unsignedBigInteger('quantity');
            $table->date('in_date');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_ins');
    }
};
