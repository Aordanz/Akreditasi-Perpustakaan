<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add kode_dokumen column
        if (!Schema::hasColumn('dokumen_bukti', 'kode_dokumen')) {
            Schema::table('dokumen_bukti', function (Blueprint $table) {
                $table->string('kode_dokumen')->nullable()->after('sub_indikator_id');
            });
        }

        // Make nama_file and path_file nullable via raw SQL to avoid truncation issues
        DB::statement('ALTER TABLE `dokumen_bukti` MODIFY `nama_file` VARCHAR(500) NULL');
        DB::statement('ALTER TABLE `dokumen_bukti` MODIFY `path_file` VARCHAR(500) NULL');
    }

    public function down(): void
    {
        Schema::table('dokumen_bukti', function (Blueprint $table) {
            $table->dropColumn('kode_dokumen');
        });
    }
};
