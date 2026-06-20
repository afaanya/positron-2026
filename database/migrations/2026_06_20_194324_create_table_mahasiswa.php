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
        Schema::create('mahasiswa', function (Blueprint $table) {
    $table->id();

    // identitas mahasiswa
    $table->string('nama');
    $table->string('nim')->unique();
    $table->string('offering'); // TI A, TI C, dll

    // pembagian kelompok
    $table->string('kelompok')->nullable();
    $table->string('mentor_kelompok')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mahasiswa');
    }
};
