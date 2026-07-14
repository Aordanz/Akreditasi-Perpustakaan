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
            $table->integer('indikator_id')->nullable()->after('sub_komponen_id');
            $table->integer('sub_indikator_id')->nullable()->after('indikator_id');

            $table->foreign('indikator_id')
                  ->references('id')
                  ->on('indikator')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('sub_indikator_id')
                  ->references('id')
                  ->on('sub_indikator')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_bukti', function (Blueprint $table) {
            $table->dropForeign(['sub_indikator_id']);
            $table->dropForeign(['indikator_id']);
            $table->dropColumn(['sub_indikator_id', 'indikator_id']);
        });
    }
};
