<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Pembagian 17 kelompok mahasiswa baru (HMD TEI 2026): nomor => [nama, mentor].
    // Anggota per kelompok di-assign lewat mahasiswa.kelompok_id (data tidak di-commit).
    private const KELOMPOK = [
        1  => ['Charles III', 'Neta'],
        2  => ['Elizabeth II', 'Nai'],
        3  => ['Felipe VI', 'Dani'],
        4  => ['Isabella I', 'Zaya'],
        5  => ['Willem-Alexander', 'Amel'],
        6  => ['Beatrix', 'Ardan'],
        7  => ['Carl XVI Gustaf', 'Ayeng'],
        8  => ['Fredrik X', 'Gana'],
        9  => ['Margarethe II', 'Alexa'],
        10 => ['Harald V', 'Rafia'],
        11 => ['Philippe', 'Kayla'],
        12 => ['Victoria', 'Cipa'],
        13 => ['Louis XIV', 'Nabila PK'],
        14 => ['Mary Stuart', 'Arsyad'],
        15 => ['Henry VIII', 'Intan'],
        16 => ['Yekaterina II', 'Dila'],
        17 => ['George III', 'Salma'],
    ];

    public function up(): void
    {
        Schema::create('kelompok', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary();
            $table->string('nama');
            $table->string('mentor');
            $table->timestamps();
        });

        $now = now();
        DB::table('kelompok')->insert(array_map(
            fn ($id, $k) => ['id' => $id, 'nama' => $k[0], 'mentor' => $k[1], 'created_at' => $now, 'updated_at' => $now],
            array_keys(self::KELOMPOK),
            self::KELOMPOK,
        ));

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedSmallInteger('kelompok_id')->nullable()->index();
            $table->foreign('kelompok_id')->references('id')->on('kelompok')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['kelompok_id']);
            $table->dropColumn('kelompok_id');
        });

        Schema::dropIfExists('kelompok');
    }
};
