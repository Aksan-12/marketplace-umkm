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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'role' setelah kolom 'password'
            // 'pembeli' akan menjadi nilai default saat registrasi
            $table->string('role')->after('password')->default('pembeli');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'role' jika migrasi di-rollback
            $table->dropColumn('role');
        });
    }
};
