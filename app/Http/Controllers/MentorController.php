<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MentorController extends Controller
{
    /** Section keys used by the portal sidebar. */
    private array $sections = ['forum', 'ioh', 'ldk', 'nako'];

    /**
     * Mentor portal home: real mahasiswa for the logged-in mentor's offering,
     * plus any previously saved assessments.
     */
    public function home(Request $request)
    {
        $mentorUser = session('mentor_user');            // e.g. "TI-A"
        $isAdmin    = session()->has('admin_login') && ! $mentorUser;

        // Filter at DB level for performance (no in-memory filtering).
        // Admins see all; mentors see only their offering.
        $query = DB::table('mahasiswa')->orderBy('nama');
        if (! $isAdmin && $mentorUser) {
            $query->where('offering_code', $mentorUser);
        }
        $rows = $query->get();

        // Saved scores (table may not exist yet — degrade gracefully).
        $savedByMahasiswa = [];
        if (Schema::hasTable('penilaian') && $rows->count()) {
            $saved = DB::table('penilaian')
                ->whereIn('mahasiswa_id', $rows->pluck('id')->all())
                ->get();

            foreach ($saved as $p) {
                $savedByMahasiswa[$p->mahasiswa_id][$p->kegiatan] = $p->poin;
            }
        }

        $students    = [];
        $assessments = [];
        foreach ($rows as $m) {
            $saved = $savedByMahasiswa[$m->id] ?? [];
            $done  = count($saved);
            $status = $done === 0
                ? 'belum'
                : ($done >= count($this->sections) ? 'selesai' : 'proses');

            $code   = $m->offering_code ?? $this->offeringCode($m);
            $letter = str_contains($code, '-') ? substr(strrchr($code, '-'), 1) : $code;

            $students[] = [
                'id'      => $m->id,
                'nama'    => $m->nama,
                'nim'     => (string) $m->nim,
                'jurusan' => ($m->program_studi ?: '—') . '/' . $letter,
                'status'  => $status,
                'no_wa'   => $m->no_wa,
            ];
            if ($saved) {
                $assessments[$m->id] = $saved;
            }
        }

        $mentorProfile = [
            'user'     => $mentorUser ?: 'Mentor',
            'offering' => $mentorUser ?: '—',
            'prodi'    => $mentorUser ? $this->prodiFromCode($mentorUser) : '—',
        ];

        return view('mentor.home', [
            'students'      => $students,
            'assessments'   => $assessments,
            'mentorProfile' => $mentorProfile,
        ]);
    }

    /** Human-readable program studi from a mentor/offering code like "PTI-C". */
    private function prodiFromCode(string $code): string
    {
        $prefix = strtoupper(explode('-', $code)[0] ?? '');

        return match ($prefix) {
            'PTI' => 'Pendidikan Teknik Informatika',
            'TI'  => 'Teknik Informatika',
            'PTE' => 'Pendidikan Teknik Elektro',
            'TE'  => 'Teknik Elektro',
            default => '—',
        };
    }

    /**
     * Persist one section's scores for a student (upsert on nim+section).
     */
    public function savePenilaian(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id'  => 'required|integer',
            'kegiatan'      => 'required|string',
            'poin'          => 'required|integer|min:0',
        ]);

        if (! Schema::hasTable('penilaian')) {
            return response()->json([
                'ok'    => false,
                'error' => 'Tabel penilaian belum dibuat. Jalankan: php artisan migrate',
            ], 503);
        }

        DB::table('penilaian')->updateOrInsert(
            [
                'mahasiswa_id'  => $data['mahasiswa_id'],
                'kegiatan'      => $data['kegiatan'],
            ],
            [
                'poin'          => $data['poin'],
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        return response()->json(['ok' => true]);
    }

    /**
     * Normalize a mahasiswa row to an offering code like "TI-A" / "PTI-C"
     * so it can be matched against a mentor's "user" code.
     */
    private function offeringCode($m): string
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
}