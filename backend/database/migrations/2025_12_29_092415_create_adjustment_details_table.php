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
        Schema::create('adjustment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_record_id')->constrained('stock_records')->cascadeOnDelete();
            $table->enum('adjustment_type', ['update', 'delete']);
            $table->unsignedBigInteger('qty_before');
            $table->unsignedBigInteger('qty_after');
            $table->unsignedBigInteger('adjusted_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjustment_details');
    }
};
