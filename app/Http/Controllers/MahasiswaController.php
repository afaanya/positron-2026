<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            if ($mahasiswa->password != $request->password_lama) {
                return back()->withErrors([
                    'password_lama' => 'Password lama tidak sesuai.'
                ]);
            }
            $data['password'] = $request->password_baru;
        }

        DB::table('mahasiswa')
            ->where('id', session('mahasiswa_id'))
            ->update($data);

        return redirect()->route('biodata')
            ->with('success', 'Biodata berhasil diperbarui.');
    }
}