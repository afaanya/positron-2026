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

            DB::table('mahasiswa')
                ->where('id', session('mahasiswa_id'))
                ->update([
                    'no_wa' => $request->no_wa,
                ]);

            return redirect()->route('biodata')
                ->with('success', 'Nomor WhatsApp berhasil diperbarui.');
        }

        public function editPassword()
        {
            return view('mahasiswa.edit-password');
        }

        public function updatePassword(Request $request)
        {
            $request->validate([
                'password_lama' => 'required',
                'password_baru' => 'required|min:8|confirmed',
            ]);

            $mahasiswa = DB::table('mahasiswa')
                ->where('id', session('mahasiswa_id'))
                ->first();

            if ($mahasiswa->password !== $request->password_lama) {
                return back()->with('error', 'Password lama tidak sesuai.');
            }

            DB::table('mahasiswa')
                ->where('id', session('mahasiswa_id'))
                ->update([
                    'password' => $request->password_baru,
                ]);

            return back()->with('success', 'Password berhasil diperbarui.');
        }
    }