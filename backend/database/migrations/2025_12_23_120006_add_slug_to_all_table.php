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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
        Schema::table('material_ins', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
        Schema::table('material_outs', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('material_ins', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('material_outs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
