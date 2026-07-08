<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('nim');                 // links to mahasiswa.nim
            $table->string('section');             // forum | ioh | ldk | nako
            $table->json('scores');                // { aspectIndex: score }
            $table->unsignedInteger('total')->default(0);
            $table->string('mentor')->nullable();  // mentor "user" who graded
            $table->timestamps();

            $table->unique(['nim', 'section']);
            $table->index('nim');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
