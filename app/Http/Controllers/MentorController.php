<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MentorController extends Controller
{
    /** kegiatan key (section or aspect) => [section, max points], from config/penilaian.php. */
    private function kegiatanMap(): array
    {
        $map = [];
        foreach (config('penilaian.sections') as $section => $cfg) {
            $map[$section] = [$section, $cfg['max']];
            foreach ($cfg['aspects'] ?? [] as $aspect => $max) {
                $map[$aspect] = [$section, $max];
            }
        }

        return $map;
    }

    /**
     * Mentor portal home: real mahasiswa for the logged-in mentor's offering,
     * plus any previously saved assessments.
     */
    public function home(Request $request)
    {
        $mentorUser = session('mentor_user');
        $isAdmin    = session()->has('admin_login') && ! $mentorUser;

        if ($mentorUser && ! session('mentor_login_logged')) {
            $this->logMentorLogin($request, $mentorUser, session('mentor_nama', 'Unknown'));
            session(['mentor_login_logged' => true]);
        }

        $query = DB::table('mahasiswa')->orderBy('nama');
        if (! $isAdmin && $mentorUser) {
            $query->where('offering_code', $mentorUser);
        }
        $rows = $query->get();

        $savedByMahasiswa = [];
        if (Schema::hasTable('penilaian') && $rows->count()) {
            $saved = DB::table('penilaian')
                ->whereIn('mahasiswa_id', $rows->pluck('id')->all())
                ->get();

            foreach ($saved as $p) {
                $savedByMahasiswa[$p->mahasiswa_id][$p->kegiatan] = $p->poin;
            }
        }

        $kegiatanMap   = $this->kegiatanMap();
        $totalSections = count(config('penilaian.sections'));
        $students    = [];
        $assessments = [];

        foreach ($rows as $m) {
            $saved = $savedByMahasiswa[$m->id] ?? [];
            $done = collect(array_keys($saved))
                ->map(fn ($k) => $kegiatanMap[$k][0] ?? null)
                ->filter()->unique()->count();
            $status = $done === 0 ? 'belum' : ($done >= $totalSections ? 'selesai' : 'proses');

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
            if ($saved) $assessments[$m->id] = $saved;
        }

        $mentorProfile = [
            'user'     => $mentorUser ?: 'Mentor',
            'nama_panggilan' => session('mentor_nama', '—'),
            'offering' => $mentorUser ?: '—',
            'prodi'    => $mentorUser ? $this->prodiFromCode($mentorUser) : '—',
        ];

        return view('mentor.home', [
            'students'      => $students,
            'assessments'   => $assessments,
            'mentorProfile' => $mentorProfile,
        ]);
    }

    /** Riwayat login mentor — buat dilihat admin. */
    public function riwayatLogin(Request $request)
    {
        if (! Schema::hasTable('mentor_login_log')) {
            return response()->json(['ok' => false, 'error' => 'Tabel mentor_login_log belum dibuat. Jalankan: php artisan migrate'], 503);
        }

        $query = DB::table('mentor_login_log')->orderByDesc('logged_in_at');
        if ($request->filled('mentor_user')) $query->where('mentor_user', $request->query('mentor_user'));
        $logs = $query->limit(500)->get();

        return view('admin.riwayat-login', ['logs' => $logs]);
    }

    /** Insert one mentor login history row and retain its id in the session. */
    private function logMentorLogin(Request $request, string $mentorUser, string $namaMentor): void
    {
        if (! Schema::hasTable('mentor_login_log')) return;

        $logId = DB::table('mentor_login_log')->insertGetId([
            'mentor_user'  => $mentorUser,
            'nama_mentor'  => $namaMentor,
            'prodi'        => $this->prodiFromCode($mentorUser),
            'ip_address'   => $request->ip(),
            'user_agent'   => substr((string) $request->userAgent(), 0, 255),
            'logged_in_at' => now(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
        $request->session()->put('mentor_login_log_id', $logId);
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

    /** Persist one aspect score for a student. */
    public function savePenilaian(Request $request)
    {
        $kegiatanMap = $this->kegiatanMap();
        $data = $request->validate([
            'mahasiswa_id'  => 'required|integer',
            'kegiatan'      => ['required', 'string', \Illuminate\Validation\Rule::in(array_keys($kegiatanMap))],
            'poin'          => 'required|integer|min:0',
        ]);

        $max = $kegiatanMap[$data['kegiatan']][1];
        if ($data['poin'] > $max) {
            return response()->json(['ok' => false, 'error' => "Poin maksimal untuk {$data['kegiatan']} adalah {$max}."], 422);
        }
        if (! Schema::hasTable('penilaian')) {
            return response()->json(['ok' => false, 'error' => 'Tabel penilaian belum dibuat. Jalankan: php artisan migrate'], 503);
        }

        $mentorUser = session('mentor_user');
        $mahasiswa  = DB::table('mahasiswa')->where('id', $data['mahasiswa_id'])->first(['id', 'offering_code']);
        if (! $mahasiswa || ($mentorUser && $mahasiswa->offering_code !== $mentorUser)) {
            return response()->json(['ok' => false, 'error' => 'Mahasiswa tidak ditemukan di offering Anda.'], 403);
        }

        $section = $kegiatanMap[$data['kegiatan']][0];
        DB::transaction(function () use ($data, $section, $kegiatanMap) {
            // Remove an old total-only value once aspect-level scores replace it.
            if ($data['kegiatan'] !== $section) {
                DB::table('penilaian')
                    ->where('mahasiswa_id', $data['mahasiswa_id'])
                    ->where('kegiatan', $section)
                    ->delete();
            }

            DB::table('penilaian')->updateOrInsert(
                ['mahasiswa_id' => $data['mahasiswa_id'], 'kegiatan' => $data['kegiatan']],
                ['poin' => $data['poin'], 'created_at' => now(), 'updated_at' => now()]
            );
        });

        return response()->json(['ok' => true]);
    }

    /** Normalize a mahasiswa row to an offering code like "TI-A" / "PTI-C". */
    private function offeringCode($m): string
    {
        $offering = strtoupper(trim($m->offering ?? ''));
        if (str_contains($offering, '-')) return $offering;

        $prodi  = strtolower($m->program_studi ?? '');
        $isPend = str_contains($prodi, 'pendidikan');
        if (str_contains($prodi, 'elektro')) $prefix = $isPend ? 'PTE' : 'TE';
        else $prefix = $isPend ? 'PTI' : 'TI';
        $letter = $offering !== '' ? substr($offering, -1) : '';

        return $prefix . '-' . $letter;
    }
}
