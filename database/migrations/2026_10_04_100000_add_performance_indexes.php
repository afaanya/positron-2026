<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Dipakai poin/kartu-kendali (where mahasiswa_id) dan updateOrInsert saat mentor menyimpan nilai.
        // Unique juga mencegah baris ganda per (mahasiswa, kegiatan).
        Schema::table('penilaian', function (Blueprint $table) {
            $table->unique(['mahasiswa_id', 'kegiatan']);
        });

        // Login mentor & kontak mentor di biodata mencari berdasarkan kode offering.
        Schema::table('mentor', function (Blueprint $table) {
            $table->index('user');
        });

        // Halaman riwayat login admin: order by logged_in_at desc, filter mentor_user.
        if (Schema::hasTable('mentor_login_log')) {
            Schema::table('mentor_login_log', function (Blueprint $table) {
                $table->index(['mentor_user', 'logged_in_at']);
                $table->index('logged_in_at');
            });
        }
    }

    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            $table->dropUnique(['mahasiswa_id', 'kegiatan']);
        });

        Schema::table('mentor', function (Blueprint $table) {
            $table->dropIndex(['user']);
        });

        if (Schema::hasTable('mentor_login_log')) {
            Schema::table('mentor_login_log', function (Blueprint $table) {
                $table->dropIndex(['mentor_user', 'logged_in_at']);
                $table->dropIndex(['logged_in_at']);
            });
        }
    }
};
