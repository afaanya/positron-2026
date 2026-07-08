<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('mahasiswa', 'offering_code')) {
            Schema::table('mahasiswa', function (Blueprint $table) {
                $table->string('offering_code')->nullable()->after('offering')->index();
            });
        }

        // Backfill from the existing offering + program_studi so each student
        // maps to a mentor code like "TI-A" / "PTI-C".
        foreach (DB::table('mahasiswa')->get() as $m) {
            DB::table('mahasiswa')
                ->where('id', $m->id)
                ->update(['offering_code' => $this->codeFor($m)]);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('mahasiswa', 'offering_code')) {
            Schema::table('mahasiswa', function (Blueprint $table) {
                $table->dropColumn('offering_code');
            });
        }
    }

    private function codeFor($m): string
    {
        $offering = strtoupper(trim($m->offering ?? ''));

        // Already a full code (e.g. "PTI-C").
        if (str_contains($offering, '-')) {
            return $offering;
        }

        $prodi  = strtolower($m->program_studi ?? '');
        $isPend = str_contains($prodi, 'pendidikan');
        if (str_contains($prodi, 'elektro')) {
            $prefix = $isPend ? 'PTE' : 'TE';
        } else {
            $prefix = $isPend ? 'PTI' : 'TI';
        }

        $letter = $offering !== '' ? substr($offering, -1) : '';

        return $prefix . '-' . $letter;
    }
};
