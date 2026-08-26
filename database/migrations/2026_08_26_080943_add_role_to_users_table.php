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
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('asesor')->after('email');
            });
        }

        // Insert asesor default account
        \Illuminate\Support\Facades\DB::table('users')->updateOrInsert(
            ['email' => 'asesor@asesor.com'],
            [
                'name' => 'Asesor',
                'password' => \Illuminate\Support\Facades\Hash::make('#akreditasi2026'),
                'role' => 'asesor',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
