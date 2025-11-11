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
        Schema::create('report_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('material_id');
            $table->date('period_start');
            $table->date('period_end');
            $table->unsignedInteger('in_qty'); 
            $table->unsignedInteger('out_qty'); 
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_materials');
    }
};
