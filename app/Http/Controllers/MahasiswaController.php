<?php

namespace App\Http\Controllers;

use App\Support\PasswordHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function edit()
    {
        $biodata = DB::table('mahasiswa')
            ->where('id', session('mahasiswa_id'))
            ->first();

        return view('biodata-edit', compact('biodata'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'no_wa' => 'required|max:20',
        ]);

        $data = [
            'no_wa' => $request->no_wa,
        ];

        if (
            $request->filled('password_lama') ||
            $request->filled('password_baru') ||
            $request->filled('password_baru_confirmation')
        ) {
            $request->validate([
                'password_lama' => 'required',
                'password_baru' => 'required|min:8|confirmed',
            ]);
            $mahasiswa = DB::table('mahasiswa')
                ->where('id', session('mahasiswa_id'))
                ->first();
            if (! PasswordHelper::matches($request->password_lama, $mahasiswa->password)) {
                return back()->withErrors([
                    'password_lama' => 'Password lama tidak sesuai.'
                ]);
            }
            $data['password'] = Hash::make($request->password_baru);
        }

        DB::table('mahasiswa')
            ->where('id', session('mahasiswa_id'))
            ->update($data);

        return redirect()->route('biodata')
            ->with('success', 'Biodata berhasil diperbarui.');
    }
    public function poin()
    {
        $penilaian = DB::table('penilaian')
            ->where('mahasiswa_id', session('mahasiswa_id'))
            ->get();

        // Ubah menjadi array: forum => 90, ioh => 85, dst.
        $nilai = [];
        foreach ($penilaian as $item) {
            $nilai[$item->kegiatan] = $item->poin;
        }

        $total = $penilaian->sum('poin');

        return view('poin-penilaian-mahasiswa', [
            'nilai' => $nilai,
            'total' => $total,
            'maksimal' => 815,
            'lulus' => $total >= 575,
        ]);
    }
}