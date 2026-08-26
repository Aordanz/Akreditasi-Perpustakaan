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
        Schema::table('dokumen_bukti', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sub_indikator', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('indikator', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sub_komponen', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_bukti', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sub_indikator', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('indikator', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sub_komponen', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
