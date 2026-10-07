<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Nomor WA mentor kelompok (format internasional tanpa '+', mis. 6282257902693).
    // Isinya diisi langsung di DB production, tidak di-commit (repo public).
    public function up(): void
    {
        Schema::table('kelompok', function (Blueprint $table) {
            $table->string('mentor_wa', 20)->nullable()->after('mentor');
        });
    }

    public function down(): void
    {
        Schema::table('kelompok', function (Blueprint $table) {
            $table->dropColumn('mentor_wa');
        });
    }
};
