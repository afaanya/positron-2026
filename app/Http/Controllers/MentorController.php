<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

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

    /** Mentor portal home: real mahasiswa for the logged-in mentor's offering, plus saved assessments. */
    public function home(Request $request)
    {
        $mentorUser = session('mentor_user');
        $isAdmin = session()->has('admin_login') && ! $mentorUser;

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

            foreach ($saved as $score) {
                $savedByMahasiswa[$score->mahasiswa_id][$score->kegiatan] = (int) $score->poin;
            }
        }

        $kegiatanMap = $this->kegiatanMap();
        $totalSections = count(config('penilaian.sections'));
        $students = [];
        $assessments = [];

        foreach ($rows as $student) {
            $saved = $savedByMahasiswa[$student->id] ?? [];
            $done = collect(array_keys($saved))
                ->map(fn ($key) => $kegiatanMap[$key][0] ?? null)
                ->filter()
                ->unique()
                ->count();
            $status = $done === 0 ? 'belum' : ($done >= $totalSections ? 'selesai' : 'proses');

            $code = $student->offering_code ?? $this->offeringCode($student);
            $letter = str_contains($code, '-') ? substr(strrchr($code, '-'), 1) : $code;
            $students[] = [
                'id' => $student->id,
                'nama' => $student->nama,
                'nim' => (string) $student->nim,
                'jurusan' => ($student->program_studi ?: '—') . '/' . $letter,
                'status' => $status,
                'no_wa' => $student->no_wa,
            ];
            if ($saved) {
                $assessments[$student->id] = $saved;
            }
        }

        $mentorProfile = [
            'user' => $mentorUser ?: 'Mentor',
            'nama_panggilan' => session('mentor_nama', '—'),
            'offering' => $mentorUser ?: '—',
            'prodi' => $mentorUser ? $this->prodiFromCode($mentorUser) : '—',
        ];

        return view('mentor.home', compact('students', 'assessments', 'mentorProfile'));
    }

    /** Riwayat login mentor — untuk admin. */
    public function riwayatLogin(Request $request)
    {
        if (! Schema::hasTable('mentor_login_log')) {
            return response()->json([
                'ok' => false,
                'error' => 'Tabel mentor_login_log belum dibuat. Jalankan: php artisan migrate',
            ], 503);
        }

        $query = DB::table('mentor_login_log')->orderByDesc('logged_in_at');
        if ($request->filled('mentor_user')) {
            $query->where('mentor_user', $request->query('mentor_user'));
        }

        return view('admin.riwayat-login', ['logs' => $query->limit(500)->get()]);
    }

    /** Insert one login history row and retain its id in the session. */
    private function logMentorLogin(Request $request, string $mentorUser, string $namaMentor): void
    {
        if (! Schema::hasTable('mentor_login_log')) {
            return;
        }

        $logId = DB::table('mentor_login_log')->insertGetId([
            'mentor_user' => $mentorUser,
            'nama_mentor' => $namaMentor,
            'prodi' => $this->prodiFromCode($mentorUser),
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
            'logged_in_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $request->session()->put('mentor_login_log_id', $logId);
    }

    /** Human-readable program studi from a mentor/offering code like "PTI-C". */
    private function prodiFromCode(string $code): string
    {
        return match (strtoupper(explode('-', $code)[0] ?? '')) {
            'PTI' => 'Pendidikan Teknik Informatika',
            'TI' => 'Teknik Informatika',
            'PTE' => 'Pendidikan Teknik Elektro',
            'TE' => 'Teknik Elektro',
            default => '—',
        };
    }

    /**
     * Save a complete section atomically. Legacy clients posting a single kegiatan/poin
     * remain supported; new clients submit section + all aspect scores in one request.
     */
    public function savePenilaian(Request $request)
    {
        $sections = config('penilaian.sections');
        $kegiatanMap = $this->kegiatanMap();
        $isBatch = $request->exists('section') || $request->exists('scores');

        if ($isBatch) {
            $data = $request->validate([
                'mahasiswa_id' => 'required|integer',
                'section' => ['required', 'string', Rule::in(array_keys($sections))],
                'scores' => 'required|array|min:1',
                'scores.*' => 'required|integer|min:0',
            ]);

            $aspectLimits = $sections[$data['section']]['aspects'] ?? [];
            $submittedKeys = array_map('strval', array_keys($data['scores']));
            $expectedKeys = array_map('strval', array_keys($aspectLimits));
            if (! $aspectLimits || array_diff($expectedKeys, $submittedKeys) || array_diff($submittedKeys, $expectedKeys)) {
                return response()->json(['ok' => false, 'error' => 'Kirim nilai untuk semua aspek yang valid pada bagian ini.'], 422);
            }

            foreach ($data['scores'] as $aspect => $points) {
                if ($points > $aspectLimits[$aspect]) {
                    return response()->json([
                        'ok' => false,
                        'error' => "Poin maksimal untuk {$aspect} adalah {$aspectLimits[$aspect]}.",
                    ], 422);
                }
            }
        } else {
            $data = $request->validate([
                'mahasiswa_id' => 'required|integer',
                'kegiatan' => ['required', 'string', Rule::in(array_keys($kegiatanMap))],
                'poin' => 'required|integer|min:0',
            ]);

            $max = $kegiatanMap[$data['kegiatan']][1];
            if ($data['poin'] > $max) {
                return response()->json([
                    'ok' => false,
                    'error' => "Poin maksimal untuk {$data['kegiatan']} adalah {$max}.",
                ], 422);
            }
        }

        if (! Schema::hasTable('penilaian')) {
            return response()->json([
                'ok' => false,
                'error' => 'Tabel penilaian belum dibuat. Jalankan: php artisan migrate',
            ], 503);
        }

        $mentorUser = session('mentor_user');
        $student = DB::table('mahasiswa')
            ->where('id', $data['mahasiswa_id'])
            ->first(['id', 'offering_code']);
        if (! $student || ($mentorUser && $student->offering_code !== $mentorUser)) {
            return response()->json(['ok' => false, 'error' => 'Mahasiswa tidak ditemukan di offering Anda.'], 403);
        }

        DB::transaction(function () use ($isBatch, $data) {
            if ($isBatch) {
                foreach ($data['scores'] as $activity => $points) {
                    DB::table('penilaian')->updateOrInsert(
                        ['mahasiswa_id' => $data['mahasiswa_id'], 'kegiatan' => $activity],
                        ['poin' => $points, 'created_at' => now(), 'updated_at' => now()]
                    );
                }

                // Keep the historical section total until every aspect upsert succeeded.
                // The transaction ensures the total is removed only with a complete replacement.
                DB::table('penilaian')
                    ->where('mahasiswa_id', $data['mahasiswa_id'])
                    ->where('kegiatan', $data['section'])
                    ->delete();
                return;
            }

            // Legacy single-score endpoint: save without deleting legacy or aspect rows.
            DB::table('penilaian')->updateOrInsert(
                ['mahasiswa_id' => $data['mahasiswa_id'], 'kegiatan' => $data['kegiatan']],
                ['poin' => $data['poin'], 'created_at' => now(), 'updated_at' => now()]
            );
        });

        return response()->json(['ok' => true]);
    }

    /** Normalize a mahasiswa row to an offering code like "TI-A" / "PTI-C". */
    private function offeringCode($student): string
    {
        $offering = strtoupper(trim($student->offering ?? ''));
        if (str_contains($offering, '-')) {
            return $offering;
        }

        $prodi = strtolower($student->program_studi ?? '');
        $isEducation = str_contains($prodi, 'pendidikan');
        $prefix = str_contains($prodi, 'elektro')
            ? ($isEducation ? 'PTE' : 'TE')
            : ($isEducation ? 'PTI' : 'TI');
        $letter = $offering !== '' ? substr($offering, -1) : '';

        return $prefix . '-' . $letter;
    }
}
